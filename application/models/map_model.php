<?php
class Map_model extends CI_Model
{

    public function get_person_detail($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get('epe0')
            ->row();
        return $rs;
    }

    public function get_by_ampur($a, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where('amp_code', $a)
            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ampur_code506($a, $c, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ampur_code506_ptstatus($a, $c, $p, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ampur_code506_nation($a, $c, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'nation' => $n,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ampur_code506_ptstatus_nation($a, $c, $p, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'nation' => $n,
                'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }


    public function get_by_ampur_ptstatus($a, $p, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                //'nation' => $n,
                'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }


    public function get_by_ampur_ptstatus_nation($a, $p, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'nation' => $n,
                'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ampur_nation($a, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                'amp_code' => $a,
                'nation' => $n,
                //'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_code506($c, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                //'nation' => $n,
                //'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_code506_ptstatus($c, $p, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                //'nation' => $n,
                'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_code506_nation($c, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                'nation' => $n,
                //'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_code506_ptstatus_nation($c, $p, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                'nation' => $n,
                'result' => $p,
                'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ptstatus($p, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                //'nation' => $n,
                'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_ptstatus_nation($p, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                'nation' => $n,
                'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_by_nation($p, $n, $s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            ->where(array(
                //'amp_code' => $a,
                'nation' => $n,
                //'result' => $p,
                //'disease' => $c
            ))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }

    public function get_all($s, $e)
    {
        $rs = $this->db
			->where('e0_hosp is not null')
            //->where(array(
                //'amp_code' => $a,
                //'nation' => $n,
                //'result' => $p,
                //'disease' => $c
            //))

            ->where('datesick >=', $s)
            ->where('datesick <=', $e)

            ->get('epe0')
            ->result();

        return $rs;
    }


    public function save_map($id, $lat, $lng)
    {
        $rs = $this->db
            ->where('id', $id)
            ->set('latitude', $lat)
            ->set('longtitude', $lng)
            ->update('epe0');

        return $rs;
    }
}