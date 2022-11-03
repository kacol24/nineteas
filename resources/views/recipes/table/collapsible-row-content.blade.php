<div class="px-2 py-3">
    <table class="border border-collapse">
        <thead>
        <tr>
            <th class="border px-3 py-1">#</th>
            <th class="border px-3 py-1">Ingredient</th>
            <th class="border px-3 py-1">Price / Pack</th>
            <th class="border px-3 py-1">Unit / Pack</th>
            <th class="border px-3 py-1">Unit / Recipe</th>
            <th class="border px-3 py-1">COGS (Rp)</th>
        </tr>
        </thead>
        @foreach($getRecord()->ingredients as $recipeIngredient)
            <tr class="text-left">
                <th class="border px-3 py-1">
                    {{ $loop->iteration }}
                </th>
                <th class="border px-3 py-1">
                    {{ $recipeIngredient->ingredient->name }}
                </th>
                <th class="border px-3 py-1">
                    {{ $recipeIngredient->ingredient->formatted_price_per_pack }}
                </th>
                <th class="border px-3 py-1">
                    {{ $recipeIngredient->ingredient->formatted_unit_per_pack }}
                </th>
                <td class="border px-3 py-1 font-mono">
                    <table class="w-full">
                        <tr>
                            <td class="text-right px-1" style="width: 50%;">
                                {{ $recipeIngredient->unit_per_recipe }}
                            </td>
                            <td style="width: 50%;" class="px-1">
                                {{ $recipeIngredient->ingredient->unit->name }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="border px-3 py-1 text-right font-mono">
                    {{ $recipeIngredient->formatted_cogs }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
