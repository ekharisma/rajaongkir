<?php

namespace Kavist\RajaOngkir;

use Kavist\RajaOngkir\Contracts\HttpClientContract;
use Kavist\RajaOngkir\Contracts\SearchDriverContract;
use Kavist\RajaOngkir\HttpClients\BasicClient;
use Kavist\RajaOngkir\Resources\Kota;
use Kavist\RajaOngkir\Resources\OngkosKirim;
use Kavist\RajaOngkir\Resources\Provinsi;
use Kavist\RajaOngkir\SearchDrivers\BasicDriver;

class RajaOngkir
{
    /** @var HttpClientContract */
    protected $httpClient;

    /** @var SearchDriverContract */
    protected $searchDriver;

    /** @var array */
    protected $options;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $package;

    /**
     * @param string $apiKey
     * @param string $package
     */
    public function __construct(string $apiKey, string $package = 'starter')
    {
        $this->apiKey = $apiKey;
        $this->package = $package;

        $this->setHttpClient(new BasicClient);
    }

    /**
     * @param HttpClientContract $httpClient
     * @return self
     */
    public function setHttpClient(HttpClientContract $httpClient): self
    {
        $this->httpClient = $httpClient;
        $this->httpClient->setApiKey($this->apiKey);
        $this->httpClient->setPackage($this->package);

        return $this;
    }

    /**
     * @param SearchDriverContract $searchDriver
     * @return self
     */
    public function setSearchDriver(SearchDriverContract $searchDriver): self
    {
        $this->searchDriver = $searchDriver;

        return $this;
    }

    /**
     * @return Provinsi;
     */
    public function provinsi(): Provinsi
    {
        $resource = new Provinsi($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @return Kota;
     */
    public function kota(): Kota
    {
        $resource = new Kota($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @param array $payload
     * @return OngkosKirim;
     */
    public function ongkosKirim(array $payload): OngkosKirim
    {
        return new OngkosKirim($this->httpClient, $payload);
    }

    /**
     * @return OngkosKirim;
     */
    public function ongkir(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }

    /**
     * @return OngkosKirim;
     */
    public function biaya(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }
}
