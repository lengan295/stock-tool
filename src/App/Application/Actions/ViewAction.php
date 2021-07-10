<?php


namespace App\Application\Actions;


use App\Application\Constants\ViewConstants;
use App\Application\Settings\SettingsInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

abstract class ViewAction extends Action {

    /**
     * @var PhpRenderer
     */
    protected $view;

    public function __construct(
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        SettingsInterface $settings,
        PhpRenderer $view
    ) {
        parent::__construct($logger, $entityManager, $settings);
        $this->view = $view;
    }

    protected function render(string $template, array $data = []): Response {
        $data["js_dir"] = ViewConstants::JS_DIR;
        $data["css_dir"] = ViewConstants::CSS_DIR;
        return $this->view->render($this->response, $template, $data);
    }
}
