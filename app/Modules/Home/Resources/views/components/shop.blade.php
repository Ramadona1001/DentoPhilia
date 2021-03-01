@if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Shop')
<div class="section-filters-bar v7">
    <div class="section-filters-bar-actions">
      <div class="section-filters-bar-info">
        <p class="section-filters-bar-title">

            <a href="{{ route('create_items') }}" class="button secondary" title="{{ transWord('New Item') }}" style="color: white;">
                <svg class="menu-item-link-icon icon-plus-small" style="fill: white;">
                    <use xlink:href="#svg-plus-small"></use>
                </svg>
                &nbsp;{{ transWord('New Item') }}
            </a>

        </p>
      </div>
    </div>
</div>

@endif
