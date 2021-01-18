<div class="uk-card-default uk-card-body">
    <!-- CategorySelection -->
    <div id="category-selection">
        <legend class="uk-legend">Select Category for uploaded Files</legend>
        <div class="uk-margin">
            {{ Form::select('category', $categories, null, ['id' => 'category_id', 'class' => 'uk-select uk-form-width-medium']) }}
            <button id="js-select-category" class="uk-button uk-button-secondary">Select</button>
        </div>
    </div>

    <h3>Upload</h3>
    <div class="js-upload uk-placeholder uk-text-center">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <span uk-icon="icon: cloud-upload"></span>
        <span class="uk-text-middle">Attach binaries by dropping them here or</span>
        <div uk-form-custom>
            <input type="file" name="file" id="file" multiple>
            <span class="uk-link">selecting one</span>
        </div>
    </div>
</div>

<div class="uk-progress-margin">
    <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
</div>