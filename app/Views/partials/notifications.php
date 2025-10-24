<?php
$notificationCount = !empty($notifications) ? count($notifications) : 0;
?>
<!-- Notifications Dropdown -->
<li class="nav-item dropdown me-3">
    <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <?php if ($notificationCount > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $notificationCount ?>
                <span class="visually-hidden">unread notifications</span>
            </span>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationsDropdown">
        <li>
            <h6 class="dropdown-header">Notifications</h6>
        </li>
        <?php if (empty($notifications)): ?>
            <li><p class="dropdown-item text-muted mb-0">You're all caught up!</p></li>
        <?php else: ?>
            <?php foreach ($notifications as $notification): ?>
                <li>
                    <a class="dropdown-item notification-item" href="#">
                        <small class="text-muted"><?= isset($notification['created_at']) ? date('M d, h:i A', strtotime($notification['created_at'])) : '' ?></small>
                        <p class="mb-0"><?= esc($notification['message'] ?? $notification) ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
        <?php endif; ?>
    </ul>
</li>