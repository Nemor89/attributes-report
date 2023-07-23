<?php

namespace App\Console\Command;

use App\Weather\OpenWeatherGateway;
use App\Weather\Response\ApiResponse;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'app:weather-forecast',
    description: 'Получить температуру воздуха по названию города',
    hidden: false
)]
class WeatherForecast extends Command
{
    protected function configure()
    {
        parent::configure();

        $this->addOption(
            'city',
            null,
            InputOption::VALUE_REQUIRED,
            'Название города, по которому запрашивается температура, на латинице',
            null
        );
    }

    public function __construct(
        private readonly OpenWeatherGateway $openWeatherGateway,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $response = $this->openWeatherGateway->getWeatherForecastByCity($input->getOption('city'));

            $this->printSuccess($output, $response);

            return Command::SUCCESS;
        } catch (Throwable $exception) {
            $this->printError($output, $exception);

            return Command::FAILURE;
        }
    }

    private function printSuccess(
        OutputInterface $output,
        ApiResponse $response
    ): void
    {
        $output->writeln("<info>В городе {$response->getCity()} {$response->getDescription()}</info>");
        $output->writeln("<info>Температура воздуха составляет {$response->getTemperature()} градусов</info>");
    }

    private function printError(
        OutputInterface $output,
        Throwable $exception
    ): void
    {
        $output->writeln("<error>Произошла ошибка:</error>");
        $output->writeln("<error>{$exception->getMessage()}</error>");
    }
}