<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * ProjectServiceContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class ProjectServiceContainer extends Container
{
    private static $parameters = array(
            'root_dir' => 'C:\\Users\\vtphan\\www\\symfony-journey-di\\start\\dino_container',
            'logger_start_message' => 'The logger has just started',
        );

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array();
        $this->scopeChildren = array();
        $this->methodMap = array(
            'logger' => 'getLoggerService',
            'logger.std_out_handler' => 'getLogger_StdOutHandlerService',
            'logger.stream_handler' => 'getLogger_StreamHandlerService',
        );

        $this->aliases = array();
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * Gets the 'logger' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Monolog\Logger A Monolog\Logger instance.
     */
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Monolog\Logger('main', array(0 => $this->get('logger.stream_handler')));

        $instance->pushHandler($this->get('logger.std_out_handler'));
        $instance->debug('The logger has just started');

        return $instance;
    }

    /**
     * Gets the 'logger.std_out_handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Monolog\Handler\StreamHandler A Monolog\Handler\StreamHandler instance.
     */
    protected function getLogger_StdOutHandlerService()
    {
        return $this->services['logger.std_out_handler'] = new \Monolog\Handler\StreamHandler('php://stdout');
    }

    /**
     * Gets the 'logger.stream_handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Monolog\Handler\StreamHandler A Monolog\Handler\StreamHandler instance.
     */
    protected function getLogger_StreamHandlerService()
    {
        return $this->services['logger.stream_handler'] = new \Monolog\Handler\StreamHandler('C:\\Users\\vtphan\\www\\symfony-journey-di\\start\\dino_container/dino.log');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset(self::$parameters[$name]) || array_key_exists($name, self::$parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return self::$parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset(self::$parameters[$name]) || array_key_exists($name, self::$parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag(self::$parameters);
        }

        return $this->parameterBag;
    }
}
