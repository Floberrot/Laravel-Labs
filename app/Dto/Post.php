<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\Request;

class Post
{
    public function __construct(
        private string $title,
        private string $content,
        private array $tags
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    private static function validate(array $request): void
    {
        if (empty($request['title']) || !is_string($request['title'])) {
            throw new \Exception('title should be sent');
        }

        if (empty($request['content']) || !is_string($request['content'])) {
            throw new \Exception('content should be sent');
        }

        if (!empty($request['tags'])) {
            foreach ($request['tags'] as $tag) {
                if (!is_string($tag)) {
                    throw new \Exception('content should be string');
                }
            }
        }
    }

    /**
     * @throws \Exception
     */
    public static function fromRequest(Request $request): self
    {
        $requestDecoded = json_decode($request->getContent(), true);
        self::validate($requestDecoded);
        return new self(
            title: $request['title'],
            content: $request['content'],
            tags: $request['tags'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'tags' => $this->getTags(),
        ];
    }
}
