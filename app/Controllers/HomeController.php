<?php
// app/Controllers/HomeController.php

require_once dirname(__DIR__, 2) . '/config/app.php';
require_once dirname(__DIR__) . '/Models/Template.php';
require_once dirname(__DIR__) . '/Models/Event.php';

class HomeController {
    private $templateModel;
    private $eventModel;

    public function __construct() {
        $this->templateModel = new Template();
        $this->eventModel = new Event();
    }

    public function index() {
        $host = strtolower($_SERVER['HTTP_HOST'] ?? '');

        // Jika diakses dari subdomain invite.pendarloka.biz.id atau parameter ?app=invite
        if (str_starts_with($host, 'invite.') || (isset($_GET['app']) && $_GET['app'] === 'invite')) {
            $categories = $this->templateModel->getCategories();
            $selectedCat = $_GET['cat'] ?? null;
            $templates = $this->templateModel->getAll($selectedCat);
            $counts = $this->eventModel->getCounts();

            require_once BASE_PATH . '/views/public/home.php';
            return;
        }

        // Default landing page utama Pendar Loka: Hub Direktori & Link-in-Bio
        require_once BASE_PATH . '/views/public/directory.php';
    }

    public function directory() {
        require_once BASE_PATH . '/views/public/directory.php';
    }

    public function links() {
        require_once BASE_PATH . '/views/public/directory.php';
    }

    public function invite() {
        $categories = $this->templateModel->getCategories();
        $selectedCat = $_GET['cat'] ?? null;
        $templates = $this->templateModel->getAll($selectedCat);
        $counts = $this->eventModel->getCounts();

        require_once BASE_PATH . '/views/public/home.php';
    }

    public function harga() {
        require_once BASE_PATH . '/views/public/harga.php';
    }

    public function tema() {
        $categories = $this->templateModel->getCategories();
        $selectedCat = $_GET['cat'] ?? null;
        $templates = $this->templateModel->getAll($selectedCat);

        require_once BASE_PATH . '/views/public/tema.php';
    }

    public function tutorial() {
        require_once BASE_PATH . '/views/public/tutorial.php';
    }

    public function demo($id) {
        $template = $this->templateModel->findById($id);
        if (!$template) {
            $template = $this->templateModel->findBySlug('luxury-07') ?: $this->templateModel->getAll()[0] ?? null;
        }

        if (!$template) {
            redirect('tema');
        }

        require_once dirname(__DIR__) . '/Controllers/AdminController.php';
        AdminController::renderTemplatePreview($template);
    }
}
