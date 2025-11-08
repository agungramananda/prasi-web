<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class BackfillTranslatable extends Command
{
    protected $signature = 'trans:backfill {--locale=id : Default locale to backfill}';
    protected $description = 'Backfill existing string fields into JSON translations for translatable attributes';

    public function handle(): int
    {
        $locale = $this->option('locale') ?: config('app.locale', 'id');

        $this->info("Backfilling products...");
        Product::chunk(200, function ($items) use ($locale) {
            foreach ($items as $p) {
                $changed = false;
                foreach (['name','description'] as $attr) {
                    $raw = $p->getAttributes()[$attr] ?? null;
                    if (is_string($raw)) {
                        // If looks like JSON, skip
                        $decoded = json_decode($raw, true);
                        if (! (json_last_error() === JSON_ERROR_NONE && is_array($decoded))) {
                            $p->setTranslations($attr, [$locale => $raw]);
                            $changed = true;
                        }
                    }
                }
                if ($changed) {
                    $p->save();
                }
            }
        });

        $this->info('Backfill complete.');
        return Command::SUCCESS;
    }
}
