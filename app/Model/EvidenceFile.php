<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EvidenceFile extends Model
{
    protected $table = 'evidence_files';

    protected $fillable = ['id','file_id','evidence_id'];
}
