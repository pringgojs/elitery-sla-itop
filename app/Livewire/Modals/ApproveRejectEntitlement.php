<?php

namespace App\Livewire\Modals;

use App\Constants\Constants;
use App\Services\EcmpCustomerService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApproveRejectEntitlement extends ModalComponent
{
    use LivewireAlert;

    public $action = 'approve'; // approve, reject

    public $target; // action to method controller

    public $title = 'Anda yakin ingin menyetujui entitlement ini?';

    public $reason_rejection;

    public $pending_plan_name;

    public $entitlement_id;

    public $procurement_id;

    public $state;

    public function mount()
    {
        if ($this->action == 'approve' && ($this->state == Constants::ENTITLEMENT_ACTIVATION_REQUESTED)) {
            $this->title = 'Anda yakin ingin menerima permintaan aktivasi entitlement ini?';
        }

        if ($this->action == 'approve' && ($this->state == Constants::ENTITLEMENT_PLAN_CHANGE_REQUESTED)) {
            $this->title = 'Anda yakin ingin menerima pengajuan perubahan plan entitlement ini?';
        }

        if ($this->action == 'reject' && ($this->state == Constants::ENTITLEMENT_ACTIVATION_REQUESTED)) {
            $this->title = 'Anda yakin ingin menolak permintaan aktivasi entitlement ini?';
        }

    }

    public function render()
    {
        return view('livewire.modals.approve-reject-entitlement');
    }

    public function submit()
    {
        $service = new EcmpCustomerService;

        $response = null;
        if ($this->action == 'approve' && ($this->state == Constants::ENTITLEMENT_ACTIVATION_REQUESTED)) {
            $response = $service->approveEntitlement($this->entitlement_id);
        }

        if ($this->action == 'reject' && ($this->state == Constants::ENTITLEMENT_ACTIVATION_REQUESTED)) {
            if (! $this->reason_rejection) {
                $this->alert('error', 'Kolom alasan penolakan tidak boleh kosong!');

                return;
            }

            $response = $service->rejectEntitlement($this->entitlement_id, $this->procurement_id, $this->reason_rejection ?? 'reject');
        }

        if ($this->action == 'approve' && ($this->state == Constants::ENTITLEMENT_PLAN_CHANGE_REQUESTED)) {
            $response = $service->approveEntitlementPlanChange($this->entitlement_id, $this->pending_plan_name);
        }

        $status = $response->object()->status ?? 'failed';
        $this->alert($status == 'failed' ? 'error' : 'success', $status == 'failed' ? 'Error!' : 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger
        $this->closeModal();
    }

    public function close()
    {
        /* close modal */
        $this->closeModal();
    }

    /* Modal */
    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
