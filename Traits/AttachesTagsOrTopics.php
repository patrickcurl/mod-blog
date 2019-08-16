<?php

namespace Modules\Blog\Traits;

trait AttachesTagsOrTopics
{
    /**
         * Attach or create tags given an incoming array.
         *
         * @param array $incomingTags
         * @return array
         *
         * @author Mohamed Said <themsaid@gmail.com>
         */
    private function attachOrCreateTags(array $incomingTags): array
    {
        $tags = Tag::all();

        return collect($incomingTags)->map(function ($incomingTag) use ($tags) {
            $tag = $tags->where('slug', $incomingTag['slug'])->first();

            if (! $tag) {
                $tag = Tag::create([
                    'id'   => $id = Uuid::uuid4(),
                    'name' => $incomingTag['name'],
                    'slug' => $incomingTag['slug'],
                ]);
            }

            return (string) $tag->id;
        })->toArray();
    }

    /**
     * Attach or create a topic given an incoming array.
     *
     * @param array $incomingTopic
     * @throws \Exception
     * @return array
     */
    private function attachOrCreateTopic(array $incomingTopic): array
    {
        if ($incomingTopic) {
            $topic = Topic::where('slug', $incomingTopic['slug'])->first();

            if (! $topic) {
                $topic = Topic::create([
                    'id'   => $id = Uuid::uuid4(),
                    'name' => $incomingTopic['name'],
                    'slug' => $incomingTopic['slug'],
                ]);
            }

            return collect((string) $topic->id)->toArray();
        } else {
            return [];
        }
    }
}
