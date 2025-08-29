<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\VendorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property ?string $email
 * @property ?string $phone
 * @property ?string $address
 * @property ?string $website
 * @property ?string $contact_person_name
 * @property ?string $contact_person_email
 * @property ?string $contact_person_phone
 * @property bool $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Vendor extends Model
{
    /** @use HasFactory<VendorFactory> */
    use HasFactory;

    public const string TABLE = 'vendors';

    protected $table = self::TABLE;

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
