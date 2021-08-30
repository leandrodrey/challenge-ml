<?php

namespace App\Domain;

class RawMessage
{
    /** @var array */
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Cuenta la cantidad de elementos que tiene un array
     *
     * @return int
     */
    public function countElements(): int
    {
        return count($this->message);
    }

    /**
     * Corta el mensaje para llegar al tamaño recibido
     * Si el tamaño recibido es mayor o igual al actual no se corta
     *
     * @param int $size
     */
    public function chop(int $size)
    {
        $offset = $this->countElements() - $size;
        if ($offset > 0) {
            $this->message = array_slice($this->message, $offset);
        }
    }

    /**
     * @return array
     */
    public function getMessage(): array
    {
        return $this->message;
    }

    /**
     * Limpia los elementos del array que sean strings vacíos
     *
     * @return array
     */
    public function cleanMessage(): array
    {
        $cleanMessage = [];
        foreach ($this->message as $key => $item) {
            if (!empty($item)) {
                $cleanMessage [$key] = $item;
            }
        }
        return $cleanMessage;
    }

}
