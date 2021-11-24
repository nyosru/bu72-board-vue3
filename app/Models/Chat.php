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
            ->orderBy('vitrin-chats.created_at', 'ASC');
    }

    // получаем список чатов
    public function scopeListChatUsers($query, int $room_id)
    {
        return $query

            ->where('vitrin-chats.room_id', '=', $room_id)

            ->join('items as chat', function ($join) {
                $join
                    // ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
                    ->on('chat.id', '=', 'vitrin-chats.room_id')
                    // ->where('cats.id', '=', $cat_id)
                    // ->where('vitrin-chats.writer_id', '!=', 'chat.autor_id')
                    // ->orWhere()
                ;
            })
            // ->where('vitrin-chats.writer_id', '!=', 'items.autor_id')

            ->addSelect(
                'vitrin-chats.room_id',
                'chat.autor_id'
            )

            ->leftJoin('users as u1', function ($join) {
                $join
                    // ->where('tmoffer_company_subject.tmf_subject_id', '=', $user)
                    ->on('u1.id', '=', 'vitrin-chats.writer_id')
                    // ->where('u1.id', '!=', 'items.autor_id')
                    // ->where('cats.id', '=', $cat_id)
                    // ->orWhere()
                ;
            })
            ->addSelect(
                'vitrin-chats.writer_id',
                'u1.socset as writer_ss',
                'u1.name as writer_name'
            )

            ->groupBy('vitrin-chats.writer_id')
            // ->orderBy('vitrin-chats.created_at', 'ASC')
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
