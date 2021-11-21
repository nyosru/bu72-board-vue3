<?php

namespace App\Models;
// namespace App\Modules\Vitrin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    // use HasFactory;

    // protected static function newFactory()
    // {
    //     return \App\Modules\Vitrin\Database\factories\ChatFactory::new();
    // }

    protected $table = 'vitrin-chats';
    protected $fillable = [
        'room_id',
        'msg',
        'writer_id',
        'to_user_id'
    ];

    // получаем историю чата
    public function scopeGetChat($query, int $room_id, int $writer_id)
    {
        return $query

            ->where('vitrin-chats.room_id', '=', $room_id)

            ->where(function ($query) use ($writer_id) {
                $query
                    ->where('vitrin-chats.writer_id', '=', $writer_id)
                    ->orWhere('vitrin-chats.to_user_id', '=', $writer_id);
            })

            // ->addSelect('vitrin-chats.*')
            ->orderBy('vitrin-chats.created_at', 'ASC')

            ;
    }

    // получаем список чатов
    public function scopeListChatUsers($query, int $room_id)
    {

        return $query

            ->where('vitrin-chats.room_id', '=', $room_id)

            // ->addSelect( DB::raw('') )
            // ->join('cats', function ($join) use ($cat_id) {
            //     $join
            //         // ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
            //         ->on('items.cat_id', '=', 'cats.id')
            //         ->where('cats.id', '=', $cat_id)
            //         // ->orWhere()
            //     ;
            // })

            ->groupBy('vitrin-chats.writer_id')
            ->groupBy('vitrin-chats.to_user_id')

            // ->where(function ($query) use ($writer_id) {
            //     $query
            //         ->where('vitrin-chats.writer_id', '=', $writer_id)
            //         ->orWhere('vitrin-chats.to_user_id', '=', $writer_id);
            // })
            // ->addSelect('vitrin-chats.*')
            ->orderBy('vitrin-chats.created_at', 'ASC')
            ;
    }

    // public function scopeUserName($query)
    // {
    //     // return $query
    //     //     ->where('room_id', '=', $room_id)
    //     //     ->where(function ($query) use ($writer_id) {
    //     //         $query
    //     //             ->where('writer_id', '=', $writer_id)
    //     //             ->orWhere('to_user_id', '=', $writer_id);
    //     //     });
    // };
}
