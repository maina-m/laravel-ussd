<?php

namespace Sparors\Ussd;

use Sparors\Ussd\Exceptions\GlobaldentifierEmptyException;
use Sparors\Ussd\Exceptions\UniqueIdentifierEmptyException;

class Context
{
    private array $bag;

    public function __construct(
        private string $session_id,
        private string $msisdn,
        private string $input
    ) {
        if (0 === strlen($session_id)) {
            throw new UniqueIdentifierEmptyException();
        }

        if (0 === strlen($msisdn)) {
            throw new GlobaldentifierEmptyException();
        }

        $this->bag = [];
    }

    public static function create(string $session_id, string $msisdn, string $input): static
    {
        return new static($session_id, $msisdn, $input);
    }

    public function with(array $parameters): static
    {
        $this->bag = $parameters;

        return $this;
    }

    public function session_id(): string
    {
        return $this->session_id;
    }

    public function msisdn(): string
    {
        return $this->msisdn;
    }

    public function input(): string
    {
        return $this->input;
    }

    public function get(string $key): mixed
    {
        return $this->bag[$key] ?? null;
    }
}
