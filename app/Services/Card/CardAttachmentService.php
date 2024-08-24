<?php

namespace App\Services\Card;

use App\DataObjects\Card\CardAttachmentDTO;
use App\DataObjects\File\FileDTO;
use App\Models\Card;
use App\Models\CardAttachment;
use Illuminate\Http\UploadedFile;
use Storage;

class CardAttachmentService
{
    const DISK = 'public';

    const FOLDER = 'attachments';

    public function store(Card $card, CardAttachmentDTO $attachmentDTO): CardAttachment
    {
        return $card->attachments()->create($attachmentDTO->toArray());
    }

    public function delete(CardAttachment $cardAttachment): ?bool
    {
        Storage::disk(self::DISK)->delete($cardAttachment->path);

        return $cardAttachment->delete();
    }

    public function deleteAll(Card $card): void
    {
        if (! $card->relationLoaded('attachments')) {
            $card->load('attachments');
        }

        if ($card->attachments) {
            foreach ($card->attachments as $attachment) {
                $this->delete($attachment);
            }
        }
    }

    public function uploadFile(UploadedFile $file): FileDTO
    {
        $path = Storage::disk(self::DISK)->put(self::FOLDER, $file);

        return FileDTO::from([
            'extension' => $file->getClientOriginalExtension(),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
        ]);
    }
}
