<?php

namespace App\Http\Controllers\Cards;

use App\DataObjects\Card\CardAttachmentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentStoreRequest;
use App\Http\Resources\CardAttachment\CardAttachmentResource;
use App\Models\Card;
use App\Models\CardAttachment;
use App\Services\Card\CardAttachmentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CardAttachmentsController extends Controller
{
    public function __construct(
        public CardAttachmentService $service
    ) {
        //
    }

    public function index(Card $card): AnonymousResourceCollection
    {
        $attachments = $card->attachments()->get();

        return CardAttachmentResource::collection($attachments);
    }

    public function store(AttachmentStoreRequest $request, Card $card): CardAttachmentResource
    {
        $fileDTO = $this->service->uploadFile($request->file('file'));

        $attachment = $this->service->store($card, CardAttachmentDTO::from([
            'caption' => $request->validated('caption'),
        ], $fileDTO->toArray()));

        return CardAttachmentResource::make($attachment);
    }

    public function destroy(CardAttachment $cardAttachment): Response
    {
        $this->service->delete($cardAttachment);

        return response()->noContent();
    }
}
