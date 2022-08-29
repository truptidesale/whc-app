<?php
namespace WhcApp;

class GitDescription implements OperationInterface
{
    private $user;
    private $repository;

    function __construct(array $values)
    {
        // Extract string array into git variables.
        extract($values, EXTR_PREFIX_ALL, 'var');

        $this->user = $var_0 ?? 'null';
        $this->repository = $var_1 ?? 'null';
    }

    public function execute() : string
    {
        // Fetch Git repo information using curl
        $url = 'https://api.github.com/repos/' . $this->user . '/' . $this->repository;
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER         => false,
            CURLOPT_URL            => $url,
            CURLOPT_USERAGENT      => 'Github API'
        ]);

        $result = curl_exec($curl);

        $data = json_decode($result, TRUE);

        // Validate if description is available.
        $description = $data['description'] ?? $data['message'] ?? 'Not available!';

        // Return Git repo description.
        return $description;

        curl_close($curl);
    }
}
