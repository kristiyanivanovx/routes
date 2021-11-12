<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'from_node_id',
        'to_node_id',
        'type_id',
        'max_speed',
        'distance_in_km'
    ];

    public function getMinutesNeededAttribute() {
        // 1# s = v.t => 2# t = s/v
        // formula: #2 + 2 * hardship_level
        $road_type = Type::findOrFail($this->type_id);
        return ($this->distance_in_km / $this->max_speed ) + 2 * $road_type->hardship_level;
    }

    public function fillingStations()
    {
        return $this->hasMany(FillingStation::class, 'id');
    }

    public function from()
    {
        return $this->belongsTo(Node::class, 'from_node_id');
    }

    public function to()
    {
        return $this->belongsTo(Node::class, 'to_node_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
