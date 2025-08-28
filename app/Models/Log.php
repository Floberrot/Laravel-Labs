<?php

namespace App\Models;

use App\Enums\LogTypeEnum;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $fillable = ['message', 'type'];

    protected $casts = [
        'type' => LogTypeEnum::class,
    ];

    protected $hidden = ['updated_at'];
    protected $appends = ['info_color'];

    public function infoColor(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->type) {
                LogTypeEnum::INFO => 'yellow',
                LogTypeEnum::EMERGENCY => 'red',
                LogTypeEnum::ALERT => 'orange',
            }
        );
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }
}
