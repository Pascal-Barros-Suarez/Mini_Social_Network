<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkUser extends Model
{
    use HasFactory;

    protected $table = 'community_link_users';

    protected $fillable = [
        'user_id',
        'community_link_id',
    ];
}
