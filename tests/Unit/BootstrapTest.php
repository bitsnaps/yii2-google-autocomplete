<?php

namespace Wearesho\GoogleAutocomplete\Yii\Tests\Unit;

use GuzzleHttp;
use PHPUnit\Framework\TestCase;
use Wearesho\GoogleAutocomplete;
use yii\web\Application;

/**
 * Class BootstrapTest
 * @package Wearesho\GoogleAutocomplete\Yii\Tests\Unit
 * @coversDefaultClass \Wearesho\GoogleAutocomplete\Yii\Bootstrap
 * @internal
 */
class BootstrapTest extends TestCase
{
    public function setUp()
    {
        $application = new Application([
            'id' => 'test',
            'basePath' => __DIR__,
        ]);
        $bootstrap = new GoogleAutocomplete\Yii\Bootstrap();
        $bootstrap->bootstrap($application);
    }

    public function testSetup(): void
    {
        $this->assertTrue(\Yii::$container->has(GoogleAutocomplete\ConfigInterface::class));
        $this->assertInstanceOf(
            GoogleAutocomplete\EnvironmentConfig::class,
            \Yii::$container->get(GoogleAutocomplete\ConfigInterface::class)
        );
        $this->assertStringEndsWith(
            'wearesho-team/google-autocomplete/src',
            \Yii::getAlias('@Wearesho/GoogleAutocomplete')
        );
    }

    public function testInstantiateService(): void
    {
        $this->assertInstanceOf(
            GoogleAutocomplete\Service::class,
            \Yii::$container->get(GoogleAutocomplete\ServiceInterface::class)
        );
    }

    public function testGuzzleClientInstantiate(): void
    {
        $this->assertInstanceOf(
            GuzzleHttp\Client::class,
            \Yii::$container->get(GuzzleHttp\ClientInterface::class)
        );
    }
}
