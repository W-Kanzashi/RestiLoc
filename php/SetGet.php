<?php

/**
 * Getters/Setters class to store and retrieve data from the database]
 * @property protected $clientData: array
 * @property protected $expertData: array
 * @property protected $garageData: array
 * @property protected $mettingData: array
 * @method public setClientData(?array $clientData): void
 * @method public setExpertData(?array $expertData): void
 * @method public setGarageData(?array $prestationData): void
 * @method public setMeetingData(?array $vehiculeData): void
 * @method public getClientData(): array
 * @method public getExpertData(): array
 * @method public getGarageData(): array
 * @method public getMeetingData(): array
 */

class SetGet
{
  protected array $clientData = [];
  protected array $expertData = [];
  protected array $garageData = [];
  protected array $meetingData = [];

  public function __construct()
  {
  }

  /**
   * Save the client data
   * @param ?array $clientData
   * @return void
   */
  public function setClientData(?array $clientData = []): void
  {
    if ($clientData !== null) {
      $this->clientData = $clientData;
    }
  }

  /**
   * Set the expert data
   * @param ?array $expertData
   * @return void
   */
  public function setExpertData(?array $expertData): void
  {
    if ($expertData !== null) {
      $this->expertData = $expertData;
    }
  }

  /**
   * Set the garage data
   * @param ?array $garageData
   * @return void
   */
  public function setGarageData(?array $garageData): void
  {
    if ($garageData !== null) {
      $this->garageData = $garageData;
    }
  }

  /**
   * Set the meeting data
   * @param ?array $meetingData
   * @return void
   */
  public function setMeetingData(?array $meetingData): void
  {
    if ($meetingData !== null) {
      $this->meetingData = $meetingData;
    }
  }

  /**
   * Get the client data.
   * if no id provided, return all the data
   * @param int $id
   * @return array
   */
  public function getClientData(int $id = -1): array
  {
    if ($id === -1) {
      return $this->clientData;
    } else {
      return $this->clientData[$id];
    }
  }

  /**
   * Get the expert data
   * @return array
   */
  public function getExpertData(): array
  {
    return $this->expertData;
  }

  /**
   * Get the garage data
   * @return array
   */
  public function getGarageData(): array
  {
    return $this->garageData;
  }

  /**
   * Get the meeting data
   * @return array
   */
  public function getMeetingData(): array
  {
    return $this->meetingData;
  }
}
