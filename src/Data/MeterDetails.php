<?php

namespace Mattsolar123\Perse\Data;

class MeterDetails
{
    public function __construct(
        public string|null $mpanCore=null,
        public float|null $consumption=null,
    ) {}
}