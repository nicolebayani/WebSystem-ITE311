<?php

helper('url');


$path = trim(service('uri')->getPath(), '/');
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8B0000;">
    <div class="container">
    
        <a class="navbar-brand fw-bold" href="<?= site_url() ?>">LEARNIFY</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    
                    <a class="nav-link <?= $path === '' ? 'active' : '' ?>" href="<?= site_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'contact' ? 'active' : '' ?>" href="<?= site_url('contact') ?>">Contact</a>
                </li>
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('logout') ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $path === 'login' ? 'active' : '' ?>" href="<?= site_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $path === 'register' ? 'active' : '' ?>" href="<?= site_url('register') ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
