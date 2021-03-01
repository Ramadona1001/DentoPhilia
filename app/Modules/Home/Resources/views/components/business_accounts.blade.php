@if (Auth::user()->hasRole('Business Account'))

@if (count(checkBusinessAccountProfileIsComplete()) > 0)
    <div class="section-filters-bar v7">
      <div class="section-filters-bar-actions">
        <div class="section-filters-bar-info">
          <p class="section-filters-bar-title"><a href="{{ route('complete_profile_business_accounts') }}">{{ transWord('Please Fill Your Data ') }}</a></p>
          <p class="section-filters-bar-text">{{ transWord('Complete Your Profile') }} <a style="text-transform: uppercase;" class="highlighted" href="{{ route('complete_profile_business_accounts') }}">{{ implode(' - ',checkBusinessAccountProfileIsComplete()) }}</a></p>
        </div>
      </div>
    </div>
@else
    @if (checkApproveBusinessAccount(Auth::user()->id) == 0)
    <div class="section-filters-bar v7">
        <div class="section-filters-bar-actions">
          <div class="section-filters-bar-info">
            <p class="section-filters-bar-title">
                {{ transWord('Waiting for approval from the Admin') }}
            </p>
          </div>
        </div>
    </div>
    @else
    @include('Home::components.shop')
    @include('Home::components.lab')
    @endif
@endif

@endif
