<?php
// index.php - Front Controller & Router PENDAR LOKA

require_once __DIR__ . '/config/app.php';

// Tangkap route dari query param (rewrite) atau PATH_INFO
$route = $_GET['route'] ?? '';
$route = trim($route, '/');

// Parse segments
$segments = explode('/', $route);
$baseRoute = $segments[0] ?? '';

switch ($baseRoute) {
    // 1. Public Routes
    case '':
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        (new HomeController())->index();
        break;

    case 'harga':
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        (new HomeController())->harga();
        break;

    case 'tema':
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        (new HomeController())->tema();
        break;

    case 'demo':
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        $templateId = isset($segments[1]) ? (int)$segments[1] : 0;
        (new HomeController())->demo($templateId);
        break;

    case 'tutorial':
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        (new HomeController())->tutorial();
        break;

    // 2. Auth Routes
    case 'login':
        require_once __DIR__ . '/app/Controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case 'register':
        require_once __DIR__ . '/app/Controllers/AuthController.php';
        (new AuthController())->register();
        break;

    case 'logout':
        require_once __DIR__ . '/app/Controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    // 3. User Dashboard Routes
    case 'dashboard':
        require_once __DIR__ . '/app/Controllers/DashboardController.php';
        $controller = new DashboardController();
        $action = $segments[1] ?? 'index';

        if ($action === 'create') {
            $controller->create();
        } elseif ($action === 'builder' && isset($segments[2])) {
            $controller->builder((int)$segments[2]);
        } elseif ($action === 'ajax-save-builder' && isset($segments[2])) {
            $controller->ajaxSaveBuilder((int)$segments[2]);
        } elseif ($action === 'edit' && isset($segments[2])) {
            $controller->edit((int)$segments[2]);
        } elseif ($action === 'upload-photo' || $action === 'upload') {
            $controller->uploadPhoto();
        } elseif ($action === 'upload-music') {
            $controller->uploadMusic();
        } elseif ($action === 'guests' && isset($segments[2])) {
            if (isset($segments[3]) && $segments[3] === 'print') {
                $controller->printGuests((int)$segments[2]);
            } else {
                $controller->guests((int)$segments[2]);
            }
        } else {
            $controller->index();
        }
        break;

    // 4. Admin Routes
    case 'admin':
        require_once __DIR__ . '/app/Controllers/AdminController.php';
        $controller = new AdminController();
        $action = $segments[1] ?? 'index';

        if ($action === 'events') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'delete' && isset($segments[3])) {
                $controller->deleteEvent((int)$segments[3]);
            } elseif ($subAction === 'update-tradition' && isset($segments[3])) {
                $controller->updateEventTradition((int)$segments[3]);
            } else {
                $controller->events();
            }
        } elseif ($action === 'traditions') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'save') {
                $controller->saveTradition();
            } elseif ($subAction === 'delete' && isset($segments[3])) {
                $controller->deleteTradition($segments[3]);
            } elseif ($subAction === 'apply' && isset($segments[3])) {
                $controller->applyTraditionToEvent((int)$segments[3]);
            } elseif ($subAction === 'reset') {
                $controller->resetTraditions();
            } else {
                $controller->traditions();
            }
        } elseif ($action === 'users') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'save') {
                $controller->saveUser();
            } elseif ($subAction === 'delete' && isset($segments[3])) {
                $controller->deleteUser((int)$segments[3]);
            } elseif ($subAction === 'reset-password' && isset($segments[3])) {
                $controller->resetUserPassword((int)$segments[3]);
            } else {
                $controller->users();
            }
        } elseif ($action === 'templates') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'save') {
                $controller->saveTemplate();
            } elseif ($subAction === 'import') {
                $controller->importTemplate();
            } elseif ($subAction === 'export' && isset($segments[3])) {
                $controller->exportTemplate((int)$segments[3]);
            } elseif ($subAction === 'preview' && isset($segments[3])) {
                $controller->previewTemplate((int)$segments[3]);
            } elseif ($subAction === 'toggle' && isset($segments[3])) {
                $controller->toggleTemplate((int)$segments[3]);
            } elseif ($subAction === 'delete' && isset($segments[3])) {
                $controller->deleteTemplate((int)$segments[3]);
            } else {
                $controller->templates();
            }
        } elseif ($action === 'plugins') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'toggle' && isset($segments[3])) {
                $controller->togglePlugin($segments[3]);
            } elseif ($subAction === 'delete' && isset($segments[3])) {
                $controller->deletePlugin($segments[3]);
            } elseif ($subAction === 'import') {
                $controller->importPlugin();
            } else {
                $controller->plugins();
            }
        } elseif ($action === 'engine') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'create') {
                $controller->createEngine();
            } elseif ($subAction === 'edit' && isset($segments[3])) {
                $controller->editEngine($segments[3]);
            } elseif ($subAction === 'duplicate' && isset($segments[3])) {
                $controller->duplicateEngine($segments[3]);
            } else {
                $controller->engine();
            }
        } elseif ($action === 'settings') {
            $subAction = $segments[2] ?? '';
            if ($subAction === 'save') {
                $controller->saveSettings();
            } else {
                $controller->settings();
            }
        } elseif ($action === 'customize' && isset($segments[2])) {
            $controller->customize((int)$segments[2]);
        } elseif ($action === 'toggle' && isset($segments[2])) {
            $controller->toggleEventStatus((int)$segments[2]);
        } else {
            $controller->index();
        }
        break;

    // 5. Invitation View Routes: /u/{slug} atau /undangan/{slug}
    case 'u':
    case 'undangan':
        require_once __DIR__ . '/app/Controllers/InvitationController.php';
        $slug = $segments[1] ?? '';
        $subAction = $segments[2] ?? '';

        if (empty($slug)) {
            redirect('');
        }

        $controller = new InvitationController();
        if ($subAction === 'rsvp') {
            $controller->rsvp($slug);
        } else {
            $controller->show($slug);
        }
        break;

    default:
        // Coba cek apakah langsung berupa slug acara (misal /pendar-loka/budi-siti)
        require_once __DIR__ . '/app/Models/Event.php';
        $eventModel = new Event();
        $event = $eventModel->findBySlug($baseRoute);
        if ($event) {
            require_once __DIR__ . '/app/Controllers/InvitationController.php';
            (new InvitationController())->show($baseRoute);
        } else {
            http_response_code(404);
            require_once __DIR__ . '/views/public/404.php';
        }
        break;
}
