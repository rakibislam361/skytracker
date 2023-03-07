<x-forms.patch :action="route('frontend.user.profile.update')">
    <div class="form-group row">
        <label for="name" class="col-md-3 col-form-label text-md-right">@lang('Name')</label>

        <div class="col-md-9">
            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                value="{{ old('name') ?? $logged_in_user->name }}" required autofocus autocomplete="name" />
        </div>
    </div>
    <!--form-group-->
    @if ($logged_in_user->canChangeEmail())
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label text-md-right">@lang('E-mail Address')</label>

            <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $logged_in_user->email }}"
                    required autocomplete="email" />
                {{-- <x-utils.alert type="info" class="mb-3" :dismissable="false">
                <i class="fas fa-info-circle"></i> @lang('If you change your e-mail you will be logged out until you confirm your new e-mail address.')
            </x-utils.alert> --}}
            </div>
        </div>
        <!--form-group-->
    @endif
    <div class="form-group row">
        <label for="phone" class="col-md-3 col-form-label text-md-right">@lang('Phone')</label>

        <div class="col-md-9">
            <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}"
                value="{{ old('phone') ?? $logged_in_user->phone }}" required autofocus autocomplete="phone" />
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-md-3 col-form-label text-md-right">@lang('Address')</label>

        <div class="col-md-9">
            <input type="text" name="address" class="form-control" placeholder="{{ __('Address') }}"
                value="{{ old('address') ?? $logged_in_user->address }}" required autofocus autocomplete="address" />
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
        </div>
    </div>
    <!--form-group-->
</x-forms.patch>
