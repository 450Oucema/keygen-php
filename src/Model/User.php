<?php

namespace KeygenClient\Model;

class User extends AbstractKeygenModel
{
    public const OBJECT = 'users';

    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $role = null;

    public function parse(array $data): self
    {
        $user = new self();
        $user->setId($data['id']);

        foreach(array_keys($data['attributes']) as $attribute) {
            $user->$attribute = $data['attributes'][$attribute];
        }

        return $user;
    }

    public function toJson(): string
    {
        $vars = array_filter(get_object_vars($this));
        unset($vars['id']);

        return json_encode([
            'data' => [
                'type' => 'users',
                'attributes' => $vars
            ]
        ]);
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }
}