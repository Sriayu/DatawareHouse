<?php

class SchedulerCommand extends CConsoleCommand
{

    const ONCE = 'once';          /* --Once adalah Optional, (default) jika benar atau tidak ada params berikut ini benar,
									Item yang dijadwalkan hanya akan dilakukan 1 kali*/
    const HOURLY = 'hourly';      /*--Hourly adalah Optional, jika daily dilewatkan sebagai baris argumen perintah, item dijadwalkan akan
									Ulangi setiap hari pada waktu yang sama */
    const DAILY = 'daily';        /*--Daily adalah Optional, jika --daily dilewatkan sebagai baris argumen perintah, item dijadwalkan akan
									Ulangi setiap hari pada waktu yang sama*/
    const WEEKLY = 'weekly';      /*--Weekly adalah Optional, jika --weekly dilewatkan sebagai baris argumen perintah, item dijadwalkan akan
									Ulangi mingguan pada saat yang sama */
    const MONTHLY = 'monthly';    /*--Monthly adalah Optional, jika --monthly dilewatkan sebagai baris argumen perintah, item dijadwalkan akan
									Ulangi bulanan pada saat yang sama */

    /**
     * Koneksi ke yii database
     */
    private $connection;

    /**
     * Kelas Dasar setup
     */
    public function init() {
        $this->connection = Yii::app()->db;
    }

    /**
     * Cek jika yii-schedules tabel ada
     * 
     * @mengembalikan boolean - true if the tabel ada, false jika sebaliknya
     */
    public function tableExists() {
        $sql = "SELECT 1 FROM yii-schedules LIMIT 1";
        $result = $this->connection->createCommand()
            ->select('*')
            ->from('yii-schedules')
            ->limit(1);
        try {
            $result->queryScalar();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Membuat tabel yii-schedules
     */
    public function createTable() {    // Create tabel baru, apabila belum ada yg namanya "yii-schedules"
        $sql = "CREATE TABLE IF NOT EXISTS `yii-schedules` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `frequency` varchar(100) NOT NULL DEFAULT '',
            `scheduled` datetime NOT NULL,
            `executed` tinyint(1) NOT NULL DEFAULT '0',
            `deleted` tinyint(1) NOT NULL DEFAULT '0',
            `url` varchar(500) NULL DEFAULT NULL,
            `command` varchar(500) NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
        $this->connection->createCommand($sql)->execute();
    }

    
     // Menambah item schedule baru
    
	 
	public function actionAdd($name, $time, $url = null, $command = null, //default command nya= null (kalau belum diisi)
        $once = false, $hourly = false, $daily = false, $weekly = false, $monthly = false
    )
		/* @param string $name : ini required, nama yang dijadwalkan(sesuai dengan yg anda suka)
		   @param string $time : ini required, kapan jadwal yg dijadwalkan(format: Bulan/Tanggal/Tahun_Jam:Menit:Detik)
		   @param string $url  : ini optional, url untuk cURL yg akan dijadwalkan saat dijalankan
		   @param string $command: ini optional, Dapat digunakan sebagai pengganti url, Akan dijalankan dengan exec
		   @param string $daily  : Optional, jika daily dilewatkan sebagai baris argumen perintah, item dijadwal.Ulangi setiap hari pada waktu yang sama
		   @param string $Weekly : Optional, jika weekly dilewatkan sebagai baris argumen perintah, item dijadwal.Ulangi mingguan pada saat yang sama
		   @param string $Monthly : Optional, jika monthly dilewatkan sebagai baris argumen perintah, item dijadwalkan akan.Ulangi bulanan pada saat yang sama 
		*/
	
	{
		$command = 'C:\Users\IVO>schtasks.exe /run /tn Sinkronisasi_baru';    // Path dari Task Scheduler yg dijalankan di Command Prompt, dimana "Sinkronisasi_baru" adalah nama file yang dibuat di Task Scheduler
        //create tabel jika diperlukan
        if (false === $this->tableExists())
            $this->createTable();

        if ($once === false && $hourly === false && $daily === false && $weekly === false && $monthly === false)
            $once = true;

        if ((is_null($url) && is_null($command)) || (($url && $command)))
            die("you must provide either a --command or a --url parameter (but not both) eg. --url=http.. or --command='php myscript.php'\n berarti harus salah satu aja!" );

        $time = str_replace('_', ' ', $time);
        try {
            $datetime = new DateTime($time);
            // cek $time  adalah hari ini atau kemudian
            if (false === ($datetime >= new DateTime))
                throw new Exception('');
        } catch (Exception $e) {
            echo "\ninvalid time value, check that the time " . 
                "you specified is not in the past and is in " . 
                "the form Y-m-d_H:i:s " . 
                "eg. 2020-01-01 or 2020-01-01_14:00:00 will both work...\n\n";
            Yii::app()->end();
        }

        if ($once)
            $this->schedule($name, $datetime, $url, $command, self::ONCE);
        else if ($hourly)
            $this->schedule($name, $datetime, $url, $command, self::HOURLY); 
        else if ($daily)
            $this->schedule($name, $datetime, $url, $command, self::DAILY); 
        else if ($weekly)
            $this->schedule($name, $datetime, $url, $command, self::WEEKLY);
        else if ($monthly)
            $this->schedule($name, $datetime, $url, $command, self::MONTHLY);
        die;
        
    }

    /**
     * Metode pembantu untuk melakukan penjadwalan sebenarnya
     * 
     * @param  string   $name      grup nama item yg dijadwalkan
     * @param  DateTime $time      objek php DateTimen ketika item yang dijadwalkan harus terjadi
     * @param  string   $url       url untuk curl ketika item dijadwalkan dijalankan
     * @param  string   $command   perintah yang akan shell_exec'd
     * @param  string   $frequency Bagaimana sering item schedule diulangi
     */
    private function schedule($name, DateTime $time, $url, $command, $frequency) {
        
        $readableTime = $time->format('Y-m-d H:i:s');
        echo "\n(re)Scheduling '{$frequency}' scheduled item for {$readableTime}...\n\n";

        $this->connection->createCommand()->insert('yii-schedules', array( // $command : untuk menampung path dari yang dijalankan di cmd
            'name' => $name,
            'frequency' => $frequency,
            'scheduled' => $time->format('Y-m-d H:i:s'),
            'url' => $url,
            'command' => $command,
            'deleted' => 0,
            'executed' => 0
        ));

    }

    /**
     * Wrapper untuk metode jadwal, increment waktu tergantung pada
     * bagaimana ketika item yang dijadwalkan harus mengulangi sebelum memanggil metode jadwal
     *
     * 
 
     * @param  string   $name      grup nama item yg dijadwalkan
     * @param  DateTime $time      objek php DateTimen ketika item yang dijadwalkan harus terjadi
     * @param  string   $url       url untuk curl ketika item dijadwalkan dijalankan
     * @param  string   $command   command to be shell_exec'd
     * @param  string   $frequency Bagaimana sering item schedule diulangi
     */
    private function reSchedule($name, DateTime $time, $url, $command, $frequency) {

        if ($frequency === 'once') 
            return;

        switch ($frequency) {

            case self::HOURLY:
                $interval = 'PT1H';
                break;

            case self::DAILY:
                $interval = 'P1D';
                break;

            case self::WEEKLY:
                $interval = 'P7D';
                break;

            case self::MONTHLY:
                $interval = 'P1M';
                break;
            default:
                echo 'invalid frequency...';
                break;
        }

        $time->add(new DateInterval($interval));

        $this->schedule($name, $time, $url, $command, $frequency);


    }

    /**
     * Menghapus semua item yang dijadwalkan dijadwalkan. Menghapus dari database
      dengan menetapkan kolom dihapus untuk 1
     */
    public function actionRemoveall() {
        echo "\nremoving all scheduled items...\n\n";
        $this->connection->createCommand()->update('yii-schedules', array(
            'deleted' => 1
        ));
        Yii::app()->end();
    }

    /**
     * Metode pembantu untuk curl url yang diberikan dan mengembalikan hasil
     * 
     * @param  string $url url untuk cURL
     * 
     * @return string      hasil dari operasi cURL
     */
    public function executeUrl($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE); 
        curl_setopt($ch, CURLOPT_NOBODY, FALSE); // remove body 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        curl_close($ch);
        return $data;
    }

    public function executeCommand($command) {
        return shell_exec($command);
    }

    /**
     * Gunakan tugas cron untuk melakukan tindakan ini sesering
      yang Anda inginkan. Scheduler akan menangani apakah
      atau tidak untuk benar-benar melakukan apa-apa
     */
    public function actionRun($name = 'all') {
        
        echo "\nrunning app...\n\n";

        $where = 'executed = 0 AND deleted = 0';

        $params = array();
        if ($name !== 'all') {
            $where .= ' AND name = :name';
            $params = array(':name' => $name);
        }

        //mencari schedules
        $schedules = $this->connection->createCommand()
            ->select('id, name, frequency, scheduled, url, command')
            ->from('yii-schedules')
            ->where($where, $params)
            ->queryAll();

        //apakah kita harus menjalankan send
        $trigger = false;

        //mengeksekusi yang di masa lalu
        foreach ($schedules as $schedule) {
            
            $scheduled = new DateTime($schedule['scheduled']);
            $now = new DateTime;
            
            if ($scheduled <= $now) {
                
                //menandai pemicu/trigger karena item yang dijadwalkan saat ini di masa lalu atau sekarang
                $trigger = true;
                
                //memperbarui db, item sekarang telah dieksekusi
                $this->connection->createCommand()->update('yii-schedules', array(
                    'executed' => 1
                ), 'id=:id', array(':id'=>$schedule['id']));

                $url = $schedule['url'];
                if ($url)
                    $result = $this->executeUrl($url);

                $command = $schedule['command'];
                if ($command)
                    $result = $this->executeCommand($command);

                // echo "HTTP Status: {$httpCode}\n";
                echo "Command Result: {$result}\n";

                //jika diperlukan, penjadwalan ulang harus terjadi
                $this->reSchedule($schedule['name'], $scheduled, $schedule['url'], $schedule['command'], $schedule['frequency']);

            }

        }
        
        if ($trigger)
            echo "scheduled item successfully executed\n\n";
        else
            echo "nothing to do...\n\n";


        Yii::app()->end();
    }

    /**
     * Mendefinisikan perintah bantuan yang hanya output bagaimana menggunakan modul ini dari Baris perintah
     */
    public function actionHelp() {
        
        $msg  = "\nadd: adds a time value to schedule scheduled items to be sent at.\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12_13:00:00\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12 --once\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12 --daily\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12 --weekly\n";
        $msg .= "eg. ./yiic scheduled item add --name=handle --time=2013-12-12 --monthly\n\n";
        
        $msg .= "removeall: invalidates all currently scheduled scheduled items\n";
        $msg .= "eg. ./yiic scheduled item removeall\n\n";
        
        $msg .= "list: lists all currently set scheduled items\n";
        $msg .= "eg. ./yiic scheduled item list\n\n";

        $msg .= "run: used with a crontab. " . 
            "Have the crontab use the run command regularly " . 
            "(every hour perhaps?) Let the scheduler take care of the rest\n";
        $msg  .= "eg. cron [cron values] ./yiic scheduled item run\n\n";

        echo $msg;

    }

    /**
     * Daftar saat ini ditetapkan item terjadwal
     */
    public function actionList() {
        
        $schedules = $this->connection->createCommand()
            ->select('name, url, command, frequency, scheduled')
            ->from('yii-schedules')
            ->where('executed = 0 AND deleted = 0')
            ->queryAll();

        echo "\n";
        foreach ($schedules as $schedule) {
            
            if (false === is_null($schedule['url']))
                $task = $schedule['url'];

            if (false === is_null($schedule['command']))
                $task = $schedule['command'];

            echo "{$schedule['scheduled']} - {$schedule['frequency']} - {$schedule['name']} - {$task}\n";
        }

        if (count($schedules) < 1)
            echo "no scheduled items set...\n\n";
        else
            echo "\n";

    }
    

}
