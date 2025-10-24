<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/modern.css') ?>">
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/admin_sidebar') ?>

        <div class="main">
            <main class="content px-4 py-3">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
    // Notifications: single, robust implementation (uses JSON and logs)
    $(document).ready(function() {
        // Load notifications on page load
        loadNotifications();

        // Set up auto-refresh every 60 seconds
        setInterval(loadNotifications, 60000);

        // Mark all as read button
        $(document).on('click', '#mark-all-read', function() {
            markAllAsRead();
        });
    });

    function loadNotifications() {
        console.log('Loading notifications...');
        console.log('Request URL:', '<?= site_url('notifications') ?>');

        $.ajax({
            url: '<?= site_url('notifications') ?>',
            method: 'GET',
            timeout: 10000, // 10 second timeout
            dataType: 'json',
            beforeSend: function() {
                console.log('Sending notification request...');
            },
            success: function(response) {
                console.log('Notifications response:', response);
                if (response && response.success) {
                    updateNotificationBadge(response.unread_count);
                    updateNotificationsList(response.notifications);
                } else {
                    console.error('Error loading notifications:', response && response.message);
                    console.error('Debug info:', response && response.debug);
                    $('#notifications-list').html('<div class="text-center text-danger py-3">Error: ' + (response && response.message ? response.message : 'Unknown error') + '<br><small>Check console for debug info</small></div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load notifications:', status, error);
                console.error('Response text:', xhr.responseText);
                console.error('Status code:', xhr.status);

                if (status === 'timeout') {
                    $('#notifications-list').html('<div class="text-center text-warning py-3">Request timed out. Please try again.</div>');
                } else if (xhr.status === 401) {
                    $('#notifications-list').html('<div class="text-center text-warning py-3">Please log in to view notifications.</div>');
                } else if (xhr.status === 404) {
                    $('#notifications-list').html('<div class="text-center text-danger py-3">Notifications endpoint not found. Check routes.</div>');
                } else {
                    $('#notifications-list').html('<div class="text-center text-danger py-3">Failed to load notifications. Status: ' + status + ' (' + xhr.status + ')<br><small>Check console for details</small></div>');
                }
            }
        });
    }

    function updateNotificationBadge(count) {
        const badge = $('#notification-badge');
        if (count > 0) {
            badge.text(count).show();
        } else {
            badge.hide();
        }
    }

    function updateNotificationsList(notifications) {
        const list = $('#notifications-list');
        const markAllBtn = $('#mark-all-read');

        if (!Array.isArray(notifications) || notifications.length === 0) {
            list.html('<div class="text-center text-muted py-3">No notifications</div>');
            markAllBtn.hide();
            return;
        }

        let html = '';
        notifications.forEach(function(notification) {
            const isRead = notification.is_read == 1;
            const readClass = isRead ? 'text-muted' : 'fw-bold';
            const timeAgo = getTimeAgo(notification.created_at);

            html += `
                <div class="notification-item p-2 border-bottom ${readClass}" data-id="${notification.id}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="small">${notification.message}</div>
                            <div class="text-muted small">${timeAgo}</div>
                        </div>
                        ${!isRead ? `<button class="btn btn-sm btn-outline-primary mark-read" data-id="${notification.id}">Mark read</button>` : ''}
                    </div>
                </div>
            `;
        });

        list.html(html);

        // Show mark all button if there are unread notifications
        const unreadCount = notifications.filter(n => n.is_read == 0).length;
        if (unreadCount > 0) {
            markAllBtn.show();
        } else {
            markAllBtn.hide();
        }

        // Bind mark as read buttons
        $('.mark-read').on('click', function() {
            const notificationId = $(this).data('id');
            markAsRead(notificationId);
        });
    }

    function markAsRead(notificationId) {
        $.post('<?= site_url('notifications/mark_read') ?>/' + notificationId)
            .done(function(response) {
                if (response && response.success) {
                    // Mark item visually as read
                    $(`.notification-item[data-id="${notificationId}"]`).removeClass('fw-bold').addClass('text-muted');
                    $(`.mark-read[data-id="${notificationId}"]`).remove();

                    // Update badge count
                    const currentCount = parseInt($('#notification-badge').text()) || 0;
                    updateNotificationBadge(Math.max(0, currentCount - 1));

                    // Hide mark all button if no more unread notifications
                    if (currentCount - 1 <= 0) {
                        $('#mark-all-read').hide();
                    }
                } else {
                    console.error('Error marking notification as read:', response && response.message);
                }
            })
            .fail(function(xhr) {
                console.error('Failed to mark notification as read:', xhr.responseText);
            });
    }

    function markAllAsRead() {
        $.post('<?= site_url('notifications/mark_all_read') ?>')
            .done(function(response) {
                if (response && response.success) {
                    // Reload notifications to update the UI
                    loadNotifications();
                } else {
                    console.error('Error marking all notifications as read:', response && response.message);
                }
            })
            .fail(function(xhr) {
                console.error('Failed to mark all notifications as read:', xhr.responseText);
            });
    }

    function getTimeAgo(dateString) {
        const now = new Date();
        const date = new Date(dateString);
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) {
            return 'Just now';
        } else if (diffInSeconds < 3600) {
            const minutes = Math.floor(diffInSeconds / 60);
            return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
        } else if (diffInSeconds < 86400) {
            const hours = Math.floor(diffInSeconds / 3600);
            return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
        } else {
            const days = Math.floor(diffInSeconds / 86400);
            return days + ' day' + (days > 1 ? 's' : '') + ' ago';
        }
    }
    </script>
</body>
</html>
