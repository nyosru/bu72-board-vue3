<?php

namespace App\Models;
// namespace App\Modules\Vitrin\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\DB;

use App\Models\Catalogs;

class Items extends Model
{
    // use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        //         'name',
        //         'cat_id_up',
        //         'sort',
        //         'status'
        // CREATE TABLE `items` (
        //   `id` bigint(20) UNSIGNED NOT NULL,
        'name',
        'opis',
        'price',
        'old_price',
        'cat_id',
        'date',
        'autor_id',
        'status_order', // enum('buy','sell','arenda') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'какой тип обьявления',
        'status', //` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on' COMMENT 'работает или не очень',
    ];

    // protected $attributes = [
    //     'date' => date('Y-M-D'),
    // ];

    // protected static function newFactory()
    // {
    //     return \App\Modules\Vitrin\Database\factories\CatalogsFactory::new();
    // }


    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->date = date('Y-m-d');
    //     });
    // }

    public function catalog()
    {
        return $this->belongsTo(Catalogs::class);
    }


    public function scopeGetItems($query, int $cat_id = 0)
    {


        return $query

            // ->Join('tmoffer_company_subject', function ($join) use ($closer_id) {
            //     $join
            //         ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
            //         ->on('tmoffer_company_subject.tmoffer_id', '=', 'tmoffer.id');
            // })

            ->join('cats', function ($join) use ($cat_id) {

                $join
                    ->on('items.cat_id', '=', 'cats.id')
                    ->where(function ($query) use ($cat_id) {
                        $query

                            // смотрим ниже каталог ( 1 шаг)
                            ->where('cats.cat_id_up', '=', $cat_id)

                            // смотрим в текущем каталоге
                            ->orWhere('cats.id', '=', $cat_id)

                            // смотрим на 3 уровня каталогов в низ
                            ->orWhereIn(
                                'cats.id',
                                DB::table('cats as c1')
                                    ->where('c1.cat_id_up', '=', $cat_id)
                                    ->join('cats as c2', function ($join) {
                                        $join
                                            ->on('c2.cat_id_up', '=', 'c1.id');
                                    })
                                    ->select('c2.id')

                            );
                    });
            })

            ->addSelect(
                "items.*",
            )

            ->orderBy('items.date', 'DESC')
            ->groupBy('items.id')

            // ->groupBy('items.created_at')
            // ->where('items.cat_id','=', 'cats.id' )
            // ->where('items.cat_id','=', $cat_id)
            ->whereNull('items.deleted_at')





            ->leftJoin('items-img as i', function ($join) {
                $join
                    ->on('i.items_id', '=', 'items.id')
                    ->where('i.first', '=', true)
                    // ->orderBy('i.first','DESC')
                ;
            })
            // ->addSelect( DB::raw('MAX(i.first) as first') )
            ->addSelect('i.img as img1')
            // // ->addSelect('i.first as img1')
            // // ->orderBy('i.first','DESC')
            // // ->orderBy('i.id','DESC')

            //2
            ->leftJoin('items-img as i2', function ($join) {
                $join
                    ->on('i2.items_id', '=', 'items.id')
                    ->on('i2.id', '!=', 'i.id');
            })
            ->addSelect('i2.img as img2')
            //3
            ->leftJoin('items-img as i3', function ($join) {
                $join
                    ->on('i3.items_id', '=', 'items.id')
                    ->on('i3.id', '!=', 'i.id')
                    ->on('i3.id', '!=', 'i2.id');
            })
            ->addSelect('i3.img as img3')
            //4
            ->leftJoin('items-img as i4', function ($join) {
                $join
                    ->on('i4.items_id', '=', 'i.items_id')
                    ->on('i4.id', '!=', 'i.id')
                    ->on('i4.id', '!=', 'i2.id')
                    ->on('i4.id', '!=', 'i3.id');
            })
            ->addSelect('i4.img as img4')
            //5
            ->leftJoin('items-img as i5', function ($join) {
                $join
                    ->on('i5.items_id', '=', 'i.items_id')
                    ->on('i5.id', '!=', 'i.id')
                    ->on('i5.id', '!=', 'i2.id')
                    ->on('i5.id', '!=', 'i3.id')
                    ->on('i5.id', '!=', 'i4.id');
            })
            ->addSelect('i5.img as img5')
            //6
            ->leftJoin('items-img as i6', function ($join) {
                $join
                    ->on('i6.items_id', '=', 'i.items_id')
                    ->on('i6.id', '!=', 'i.id')
                    ->on('i6.id', '!=', 'i2.id')
                    ->on('i6.id', '!=', 'i3.id')
                    ->on('i6.id', '!=', 'i4.id')
                    ->on('i6.id', '!=', 'i5.id');
            })
            ->addSelect('i6.img as img6')
            //7
            ->leftJoin('items-img as i7', function ($join) {
                $join
                    ->on('i7.items_id', '=', 'i.items_id')
                    ->on('i7.id', '!=', 'i.id')
                    ->on('i7.id', '!=', 'i2.id')
                    ->on('i7.id', '!=', 'i3.id')
                    ->on('i7.id', '!=', 'i4.id')
                    ->on('i7.id', '!=', 'i5.id')
                    ->on('i7.id', '!=', 'i6.id');
            })
            ->addSelect('i7.img as img7')
            //8
            ->leftJoin('items-img as i8', function ($join) {
                $join
                    ->on('i8.items_id', '=', 'i.items_id')
                    ->on('i8.id', '!=', 'i.id')
                    ->on('i8.id', '!=', 'i2.id')
                    ->on('i8.id', '!=', 'i3.id')
                    ->on('i8.id', '!=', 'i4.id')
                    ->on('i8.id', '!=', 'i5.id')
                    ->on('i8.id', '!=', 'i6.id')
                    ->on('i8.id', '!=', 'i7.id');
            })
            ->addSelect('i8.img as img8')
            //9
            ->leftJoin('items-img as i9', function ($join) {
                $join
                    ->on('i9.items_id', '=', 'i.items_id')
                    ->on('i9.id', '!=', 'i.id')
                    ->on('i9.id', '!=', 'i2.id')
                    ->on('i9.id', '!=', 'i3.id')
                    ->on('i9.id', '!=', 'i4.id')
                    ->on('i9.id', '!=', 'i5.id')
                    ->on('i9.id', '!=', 'i6.id')
                    ->on('i9.id', '!=', 'i7.id')
                    ->on('i9.id', '!=', 'i8.id');
            })
            ->addSelect('i9.img as img9')
            //10
            ->leftJoin('items-img as i10', function ($join) {
                $join
                    ->on('i10.items_id', '=', 'i.items_id')
                    ->on('i10.id', '!=', 'i.id')
                    ->on('i10.id', '!=', 'i2.id')
                    ->on('i10.id', '!=', 'i3.id')
                    ->on('i10.id', '!=', 'i4.id')
                    ->on('i10.id', '!=', 'i5.id')
                    ->on('i10.id', '!=', 'i6.id')
                    ->on('i10.id', '!=', 'i7.id')
                    ->on('i10.id', '!=', 'i8.id')
                    ->on('i10.id', '!=', 'i9.id');
            })
            ->addSelect('i10.img as img10')

            // ->addSelect(DB::raw(
            //     ' CASE '
            //         . ' WHEN i.first = true THEN \'img1\' '
            //         . ' WHEN i2.first = true THEN \'img2\' '
            //         . ' WHEN i3.first = true  THEN \'img3\' '
            //         . ' WHEN i4.first = true  THEN \'img4\' '
            //         . ' WHEN i5.first = true  THEN \'img5\' '
            //         . ' WHEN i6.first = true  THEN \'img6\' '
            //         . ' WHEN i7.first = true  THEN \'img7\' '
            //         . ' WHEN i8.first = true  THEN \'img8\' '
            //         . ' WHEN i9.first = true  THEN \'img9\' '
            //         . ' WHEN i10.first = true  THEN \'img10\' '
            //         . ' ELSE \'img1\' END as img_first '
            // ))

        ;
    }

    public function scopeItem($query, int $item_id = 0)
    {


        return $query

            // ->Join('tmoffer_company_subject', function ($join) use ($closer_id) {
            //     $join
            //         ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
            //         ->on('tmoffer_company_subject.tmoffer_id', '=', 'tmoffer.id');
            // })

            ->where('items.id', '=', $item_id)

            // ->join('cats', function ($join) use ($cat_id) {
            //     $join
            //         // ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
            //         ->on('items.cat_id', '=', 'cats.id')
            //         ->where('cats.id', '=', $cat_id)
            //         // ->orWhere()
            //     ;
            // })

            // ->groupBy('items.id')
            // ->orderBy('items.id', 'DESC')

            // ->leftJoin( 'items-img as i ' , function ($join) {
            ->leftJoin('items-img as i', function ($join) {
                $join
                    ->on('i.items_id', '=', 'items.id')
                    // ->where('i.first', '=', true)
                ;
            })
            // ->addSelect( DB::raw('MAX(i.first) as first') )
            ->addSelect('i.img as img1')
            // ->addSelect('i.first as img1')
            // ->orderBy('i.first','DESC')
            // ->orderBy('i.id','DESC')
            //2
            ->leftJoin('items-img as i2', function ($join) {
                $join
                    ->on('i2.items_id', '=', 'i.items_id')
                    ->on('i2.id', '!=', 'i.id');
            })
            ->addSelect('i2.img as img2')
            //3
            ->leftJoin('items-img as i3', function ($join) {
                $join
                    ->on('i3.items_id', '=', 'i.items_id')
                    ->on('i3.id', '!=', 'i.id')
                    ->on('i3.id', '!=', 'i2.id');
            })
            ->addSelect('i3.img as img3')
            //4
            ->leftJoin('items-img as i4', function ($join) {
                $join
                    ->on('i4.items_id', '=', 'i.items_id')
                    ->on('i4.id', '!=', 'i.id')
                    ->on('i4.id', '!=', 'i2.id')
                    ->on('i4.id', '!=', 'i3.id');
            })
            ->addSelect('i4.img as img4')
            //5
            ->leftJoin('items-img as i5', function ($join) {
                $join
                    ->on('i5.items_id', '=', 'i.items_id')
                    ->on('i5.id', '!=', 'i.id')
                    ->on('i5.id', '!=', 'i2.id')
                    ->on('i5.id', '!=', 'i3.id')
                    ->on('i5.id', '!=', 'i4.id');
            })
            ->addSelect('i5.img as img5')
            //6
            ->leftJoin('items-img as i6', function ($join) {
                $join
                    ->on('i6.items_id', '=', 'i.items_id')
                    ->on('i6.id', '!=', 'i.id')
                    ->on('i6.id', '!=', 'i2.id')
                    ->on('i6.id', '!=', 'i3.id')
                    ->on('i6.id', '!=', 'i4.id')
                    ->on('i6.id', '!=', 'i5.id');
            })
            ->addSelect('i6.img as img6')
            //7
            ->leftJoin('items-img as i7', function ($join) {
                $join
                    ->on('i7.items_id', '=', 'i.items_id')
                    ->on('i7.id', '!=', 'i.id')
                    ->on('i7.id', '!=', 'i2.id')
                    ->on('i7.id', '!=', 'i3.id')
                    ->on('i7.id', '!=', 'i4.id')
                    ->on('i7.id', '!=', 'i5.id')
                    ->on('i7.id', '!=', 'i6.id');
            })
            ->addSelect('i7.img as img7')
            //8
            ->leftJoin('items-img as i8', function ($join) {
                $join
                    ->on('i8.items_id', '=', 'i.items_id')
                    ->on('i8.id', '!=', 'i.id')
                    ->on('i8.id', '!=', 'i2.id')
                    ->on('i8.id', '!=', 'i3.id')
                    ->on('i8.id', '!=', 'i4.id')
                    ->on('i8.id', '!=', 'i5.id')
                    ->on('i8.id', '!=', 'i6.id')
                    ->on('i8.id', '!=', 'i7.id');
            })
            ->addSelect('i8.img as img8')
            //9
            ->leftJoin('items-img as i9', function ($join) {
                $join
                    ->on('i9.items_id', '=', 'i.items_id')
                    ->on('i9.id', '!=', 'i.id')
                    ->on('i9.id', '!=', 'i2.id')
                    ->on('i9.id', '!=', 'i3.id')
                    ->on('i9.id', '!=', 'i4.id')
                    ->on('i9.id', '!=', 'i5.id')
                    ->on('i9.id', '!=', 'i6.id')
                    ->on('i9.id', '!=', 'i7.id')
                    ->on('i9.id', '!=', 'i8.id');
            })
            ->addSelect('i9.img as img9')
            //10
            ->leftJoin('items-img as i10', function ($join) {
                $join
                    ->on('i10.items_id', '=', 'i.items_id')
                    ->on('i10.id', '!=', 'i.id')
                    ->on('i10.id', '!=', 'i2.id')
                    ->on('i10.id', '!=', 'i3.id')
                    ->on('i10.id', '!=', 'i4.id')
                    ->on('i10.id', '!=', 'i5.id')
                    ->on('i10.id', '!=', 'i6.id')
                    ->on('i10.id', '!=', 'i7.id')
                    ->on('i10.id', '!=', 'i8.id')
                    ->on('i10.id', '!=', 'i9.id');
            })
            ->addSelect('i10.img as img10')

            ->addSelect(DB::raw(
                ' CASE '
                    . ' WHEN i.first = true THEN \'img1\' '
                    . ' WHEN i2.first = true THEN \'img2\' '
                    . ' WHEN i3.first = true  THEN \'img3\' '
                    . ' WHEN i4.first = true  THEN \'img4\' '
                    . ' WHEN i5.first = true  THEN \'img5\' '
                    . ' WHEN i6.first = true  THEN \'img6\' '
                    . ' WHEN i7.first = true  THEN \'img7\' '
                    . ' WHEN i8.first = true  THEN \'img8\' '
                    . ' WHEN i9.first = true  THEN \'img9\' '
                    . ' WHEN i10.first = true  THEN \'img10\' '
                    . ' ELSE \'img1\' END as img_first '
            ))

            ->addSelect(
                "items.*",
            );
    }
}
