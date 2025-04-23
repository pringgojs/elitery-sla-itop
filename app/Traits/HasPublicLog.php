<?php

namespace App\Traits;

trait HasPublicLog
{
    public function getPublicLog() {
        $text = $this->public_log;

        $pattern = '/========== ([\d-]+\s[\d:]+) : (.*?) \((\d+)\) ============\n\n(.+?)(?=\n==========|\z)/s';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
    
        $result = [];
        foreach ($matches as $match) {
            $result[] = [
                'timestamp' => $match[1],  // Waktu pesan
                'name' => $match[2],       // Nama pengirim
                'agent_id' => (int) $match[3],  // ID agen
                'message' => trim($match[4]),   // Isi pesan (bisa mengandung HTML)
            ];
        }
    
        return $result;
    }

    public function getPublicLogIndex() {
        $serializedString = $this->public_log_index;
        // Unserialize data
        $data = unserialize($serializedString);
    
        // Pastikan data hasil unserialize berupa array
        if (!is_array($data)) {
            return [];
        }
    
        return $data;
    }
}