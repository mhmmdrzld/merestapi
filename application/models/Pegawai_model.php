<?php

class Pegawai_model extends CI_Model
{
    function pegawaiByNip($nip)
    {
        $query = $this->db->query("SELECT
            nip,
            nama,
            photo,
            nama_foto,
            no_wa
        FROM
            pegawai i
        WHERE 
            i.nip = '$nip'
        
        ")->result();

        //convert PHOTO to base64
        foreach ($query as $key => $value) {
            $query[$key]->photo = base64_encode($value->photo);
        }

        return $query;
    }

    function update($data, $nip)
    {
        return $this->db->update('pegawai', $data, ['nip' => $nip]);
    }
}
