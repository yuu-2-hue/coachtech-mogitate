<div>
    @php($key = 'form.file')
    @if ($form['file'])
        <img class="item__image" style="width: 374px; height: 281px;" src="{{ $form['file']->temporaryUrl() }}" alt="">
        <div>
            <input type="file" name="image" wire:model.defer="{{ $key }}" accept="image/*">
        </div>
    @else
        <input type="file" name="image" wire:model.defer="{{ $key }}" accept="image/*">
    @endif
</div>
