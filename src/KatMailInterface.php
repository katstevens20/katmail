<?php

namespace kat;

interface KatMailInterface
{
    public function send(): ?bool;

}