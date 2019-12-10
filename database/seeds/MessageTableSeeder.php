<?php

use App\User;
use App\Message;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating messages table');
        Message::truncate();

        foreach (User::all() as $sender) {
            foreach (User::all() as $receiver) {
                if ($sender != $receiver) {
                    $message = Message::create([
                        'message' => 'Hello.',
                        'sender_id' => $sender->id,
                        'receiver_id' => $receiver->id,
                    ]);
                    $this->command->info('Create message "'.$message->message.'" from '.$message->sender->name.' to '.$message->receiver->name);
                    sleep(1);
                }
            }
        }
    }
}
