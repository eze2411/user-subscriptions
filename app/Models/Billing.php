<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed state
 */
class Billing extends Model
{
    use HasFactory;

    public function getStateLabel()
    {
        switch ($this->state)
        {
            case 'pending':
                $stateLabel = 'PENDIENTE';
                break;
            case 'paid':
                $stateLabel = 'PAGADO';
                break;
            case 'expired':
                $stateLabel = 'EXPIRADO';
                break;
            default:
                $stateLabel = 'N/A';
        }
        return $stateLabel;
    }

    public function getStateColor()
    {
        switch ($this->state)
        {
            case 'paid':
                $stateColor = 'success';
                break;
            case 'expired':
                $stateColor = 'danger';
                break;
            default:
                $stateColor = 'secondary';
        }
        return $stateColor;
    }
}
