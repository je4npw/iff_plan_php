<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Adicionar a permissão de admin
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Verifica se o usuário é admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Verifica se o usuário tem permissão de edição
    public function isEditor()
    {
        return $this->role === 'edit';
    }

    // Verifica se o usuário tem permissão de visualização
    public function isViewer()
    {
        return $this->role === 'view';
    }

    // Verifica se o usuário não tem permissões
    public function hasNoPermissions()
    {
        return $this->role === 'none';
    }
}
