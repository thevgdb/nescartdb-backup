<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $table = "carts";

    const IMAGES_DEFAULT = "[
        'cart_front' => null,
        'cart_back' => null,
        'cart_top' => null,
        'pcb_front' => null,
        'pcb_back' => null,
        'box_front' => null,
        'box_back' => null,
        'manual' => null,
        'insert' => null,
    ]";

    const IMAGES_DEFAULT__IMAGE = "[
        'nescartdb_thumbnail_src' => '',
        'nescartdb_src' => '',
        'position' => '',
        'submitted_by' => '',
        'linked_from_profile' => '',
    ]";

    const CART_PROPERTIES_DEFAULT = "[
    ]";

    const ROM_DETAILS_DEFAULT = "[
        'roms' => [],
    ]";

    const ROM_DETAILS_DEFAULT__ROM = "[
        'type' => '',
        'label' => '',
        'size' => '',
        'crc32' => '',
        'sha1' => '',
        'number_of_verifications' => '',
    ]";

    const PCB_DETAILS_DEFAULT = "[
    ]";

    const DETAILED_CHIP_INFO_DEFAULT = "[
        'chips' => [],
    ]";

    const DETAILED_CHIP_INFO_DEFAULT__CHIP = "[
        'designation' => '',
        'maker' => '',
        'part_number' => '',
        'type' => '',
        'package' => '',
        'datecode' => '',
        'datecode_normalized' => '',
        'misc' => '',
    ]";

    const CART_DETAILS_DEFAULT = "[
    ]";

    protected $attributes = [
        'cart_id' => '',
        'cart_url_slug' => '',
        'game_title' => '',
        'game_version' => '',
        'game_subtitle' => '',
        'region' => '',
        'publisher' => '',
        'catalog_id' => '',
        'pcb_name' => '',
        'submitter' => '',
        'submitted' => null,
        'backed_up_at' => null,
        'number_of_times_cart_verified' => 0,
        'images' => self::IMAGES_DEFAULT,
        'cart_details' => self::CART_DETAILS_DEFAULT,
        'cart_properties' => self::CART_PROPERTIES_DEFAULT,
        'rom_details' => self::ROM_DETAILS_DEFAULT,
        'pcb_details' => self::PCB_DETAILS_DEFAULT,
        'detailed_chip_info' => self::DETAILED_CHIP_INFO_DEFAULT,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $casts = [
        'cart_id' => 'string',
        'cart_url_slug' => 'string',
        'game_title' => 'string',
        'game_version' => 'string',
        'game_subtitle' => 'string',
        'region' => 'string',
        'publisher' => 'string',
        'catalog_id' => 'string',
        'pcb_name' => 'string',
        'submitter' => 'string',
        'submitted' => 'datetime',
        'backed_up_at' => 'datetime',
        'number_of_times_cart_verified' => 'integer',
        'images' => 'json',
        'cart_details' => 'json',
        'cart_properties' => 'json',
        'rom_details' => 'json',
        'pcb_details' => 'json',
        'detailed_chip_info' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cart_id',
        'cart_url_slug',
        'game_title',
        'game_version',
        'game_subtitle',
        'region',
        'publisher',
        'catalog_id',
        'pcb_name',
        'submitter',
        'submitted',
        'backed_up_at',
        'number_of_times_cart_verified',
        'images',
        'cart_details',
        'cart_properties',
        'rom_details',
        'pcb_details',
        'detailed_chip_info',
    ];

    /**
     * The relationships that should always be loaded.

     * @var array
     */
//    protected $with = ['uniqueGame'];

    public function publicUrl(): string
    {
        return route('cart', [
            'cart_id' => $this->getAttribute('cart_id'),
            'cart_url_slug' => $this->getAttribute('cart_url_slug'),
        ]);
    }

    /**
     * Gets the original NESCartDB URL of where this cart resource was saved/scraped from.
     *
     * @return string
     */
    public function originalUrl(): string
    {
        return "https://nescartdb.com/profile/view/" . $this->getAttribute('cart_id') . "/" . $this->getAttribute('cart_url_slug');
    }

    /**
     * Determine if this Cart has an image saved for the specified image position value.
     *
     * @param string $image_position
     * @return bool
     */
    public function hasImage(string $image_position): bool
    {
        $image_filename = $this->getAttribute('cart_id') . '_' . $image_position . '.jpg';
        return Storage::disk('public')->exists('cart_images/' . $image_filename);
    }

    /**
     * Get the full size image public URL for the image of the specified position.
     *
     * @param string $image_position
     * @return string
     */
    public function imageUrl(string $image_position): string
    {
        $image_filename = $this->getAttribute('cart_id') . '_' . $image_position . '.jpg';

        if( !$this->hasImage($image_position) ) {
            return "";
        }

        return asset('storage/cart_images/' . $image_filename);
    }

    /**
     * Get the thumbnail image public URL for the image of the specified position.
     *
     * @param string $image_position
     * @return string
     */
    public function thumbnailUrl(string $image_position): string
    {
        $thumbnail_image_filename = $this->getAttribute('cart_id') . '_' . $image_position . '_thumbnail.jpg';

        if( !$this->hasImage($image_position) ) {
            return "";
        }

        return asset('storage/cart_images/' . $thumbnail_image_filename);
    }


    public function uniqueGame(): BelongsTo
    {
        return $this->belongsTo(UniqueGame::class);
    }

    public function cartImages(): HasMany
    {
        return $this->hasMany(CartImage::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitter_id', 'id');
    }

}
