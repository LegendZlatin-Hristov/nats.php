<?php

declare(strict_types=1);

namespace Basis\Nats\Message;

abstract class Prototype
{
    abstract public function render(): string;

    public static function create(string $data)
    {
        // @phan-suppress-next-line PhanTypeInstantiateAbstractStatic
        return new static(Payload::parse($data));
    }

    public function __construct($payload = null)
    {
        if ($payload === null) {
            return;
        }

        $values = is_array($payload) ? $payload : $payload->getValues();
        if ($values === null) {
            return;
        }

        foreach ($values as $k => $v) {
            if (!property_exists($this, $k)) {
                continue; // newer servers may send fields this client version does not know
            }
            $this->$k = $v;
        }
    }
}
