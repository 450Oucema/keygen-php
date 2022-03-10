<?php

namespace KeygenClient\Model;

use DateTime;

class License extends AbstractKeygenModel
{
    private ?string $name = null;
    private ?string $key = null;
    private ?string $expiry = null;
    private ?string $status = null;
    private ?int $uses = null;
    private ?bool $suspended = null;
    private ?string $scheme = null;
    private ?bool $encrypted = null;
    private ?bool $floating = null;
    private ?bool $concurrent = null;
    private ?bool $protected = null;
    private ?int $maxMachines = null;
    private ?int $maxCores = null;
    private ?int $maxUses = null;
    private ?bool $requireCheckIn = null;
    private ?string $lastValidated = null;
    private ?string $lastCheckIn = null;
    private ?string $nextCheckIn = null;
    private ?string $created = null;
    private ?string $updated = null;

    public function parse(array $licenseData): self
    {
        $license = new self();
        $license->setId($licenseData['id']);

        foreach(array_keys($licenseData['attributes']) as $attribute) {
            $license->$attribute = $licenseData['attributes'][$attribute];
        }

        foreach(array_keys($licenseData['relationships']) as $attribute) {
            if (isset($licenseData['relationships'][$attribute]['data'])) {
                $license->addRelationship($attribute, $licenseData['relationships'][$attribute]['data']['id']);
            }
        }

        return $license;
    }

    public function isExpired(): bool
    {
        if (null === $this->expiry) {
            return false;
        }

        $today = new DateTime('now');
        $expiry = new DateTime($this->expiry);

        return $today > $expiry;
    }

    public function toJson(): string
    {
        $vars = array_filter(get_object_vars($this));
        unset($vars['id']);
        unset($vars['relationships']);

        $data = [
            'data' => [
                'type' => 'licenses',
                'attributes' => $vars,
            ]
        ];

        // Eg: ['user' => 'uuid']
        foreach (array_keys($this->getRelationships()) as $relationship) {
            $data['data']['relationships'][$relationship]['data']['id'] = $this->getRelationships()[$relationship];
            $data['data']['relationships'][$relationship]['data']['type'] = self::RELATIONSHIPS_TYPES[$relationship];
        }

        return json_encode($data);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    public function getExpiry(): ?string
    {
        return $this->expiry;
    }

    public function setExpiry(?string $expiry): void
    {
        $this->expiry = $expiry;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getUses(): ?int
    {
        return $this->uses;
    }

    public function setUses(?int $uses): void
    {
        $this->uses = $uses;
    }

    public function getSuspended(): ?bool
    {
        return $this->suspended;
    }

    public function setSuspended(?bool $suspended): void
    {
        $this->suspended = $suspended;
    }

    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    public function setScheme(?string $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getEncrypted(): ?bool
    {
        return $this->encrypted;
    }

    public function setEncrypted(?bool $encrypted): void
    {
        $this->encrypted = $encrypted;
    }

    public function getFloating(): ?bool
    {
        return $this->floating;
    }

    public function setFloating(?bool $floating): void
    {
        $this->floating = $floating;
    }

    public function getConcurrent(): ?bool
    {
        return $this->concurrent;
    }

    public function setConcurrent(?bool $concurrent): void
    {
        $this->concurrent = $concurrent;
    }

    public function getProtected(): ?bool
    {
        return $this->protected;
    }

    public function setProtected(?bool $protected): void
    {
        $this->protected = $protected;
    }

    public function getMaxMachines(): ?int
    {
        return $this->maxMachines;
    }

    public function setMaxMachines(?int $maxMachines): void
    {
        $this->maxMachines = $maxMachines;
    }

    public function getMaxCores(): ?int
    {
        return $this->maxCores;
    }

    public function setMaxCores(?int $maxCores): void
    {
        $this->maxCores = $maxCores;
    }

    public function getMaxUses(): ?int
    {
        return $this->maxUses;
    }

    public function setMaxUses(?int $maxUses): void
    {
        $this->maxUses = $maxUses;
    }

    public function getRequireCheckIn(): ?bool
    {
        return $this->requireCheckIn;
    }

    public function setRequireCheckIn(?bool $requireCheckIn): void
    {
        $this->requireCheckIn = $requireCheckIn;
    }

    public function getLastValidated(): ?string
    {
        return $this->lastValidated;
    }

    public function setLastValidated(?string $lastValidated): void
    {
        $this->lastValidated = $lastValidated;
    }

    public function getLastCheckIn(): ?string
    {
        return $this->lastCheckIn;
    }

    public function setLastCheckIn(?string $lastCheckIn): void
    {
        $this->lastCheckIn = $lastCheckIn;
    }

    public function getNextCheckIn(): ?string
    {
        return $this->nextCheckIn;
    }

    public function setNextCheckIn(?string $nextCheckIn): void
    {
        $this->nextCheckIn = $nextCheckIn;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function setCreated(?string $created): void
    {
        $this->created = $created;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    public function setUpdated(?string $updated): void
    {
        $this->updated = $updated;
    }
}