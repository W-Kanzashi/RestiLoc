<?php

class SetGet
{
  protected array $clientData = [];
  protected array $expertData = [];
  protected array $garageData = [];

  public function __construct()
  {
  }

  public function setClientData(array|null $clientData): void
  {
    if ($clientData !== null) {
      $this->clientData = $clientData;
    }
  }

  public function setExpertData(array|null $expertData): void
  {
    if ($expertData !== null) {
      $this->expertData = $expertData;
    }
  }

  public function setGarageData(array|null $garageData): void
  {
    if ($garageData !== null) {
      $this->garageData = $garageData;
    }
  }

  public function getClientData(int $id = -1): array
  {
    if ($id === -1) {
      return $this->clientData;
    } else {
      return $this->clientData[$id];
    }
  }

  public function getExpertData(): array
  {
    return $this->expertData;
  }

  public function getGarageData(): array
  {
    return $this->garageData;
  }
}
