{{'@'}}extends('brackets/admin-ui::admin.layout.default')

{{'@'}}section('title', trans('admin.{{ $modelLangFormat }}.actions.create'))

{{'@'}}section('body')

    <div class="container-xl">

        @if(!in_array("published_at", array_column($columns->toArray(), 'name')))
        <div class="card">
        @endif

        <{{ $modelJSName }}-form
            :action="'{{'{{'}} url('admin/{{ $resource }}') }}'"
            @if($hasTranslatable):locales="@{{ json_encode($locales) }}"
            :send-empty-locales="false"@endif
            inline-template>

            <form class="form-horizontal form-create" method="post" {{'@'}}submit.prevent="onSubmit" :action="this.action" novalidate>
                @if(in_array("published_at", array_column($columns->toArray(), 'name')))
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-plus"></i> {{'{{'}} trans('admin.{{ $modelLangFormat }}.actions.create') }}
                                </div>
                                <div class="card-body">
                                    {{'@'}}include('admin.{{ $modelDotNotation }}.components.form-elements')
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-5 col-xxl-4">
                            <div class="card">
                                <div class="card-header" style="height: 62px">
                                    <i class="fa fa-check"></i>@{{ trans('brackets/admin-ui::admin.forms.publish') }}</span>

                                </div>

                                <div class="card-block">
                                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('published_at'), 'has-success': this.fields.published_at && this.fields.published_at.valid }">
                                        <label for="published_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-2' : 'col-md-4'">{{ trans('admin.computer.columns.published_at') }}</label>
                                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                                            <div class="input-group input-group--custom">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <datetime v-model="form.published_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('published_at'), 'form-control-success': this.fields.published_at && this.fields.published_at.valid}" id="published_at" name="published_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
                                            </div>
                                            <div v-if="errors.has('published_at')" class="form-control-feedback form-text" v-cloak>{{'@'}}{{'{{'}}errors.first('published_at') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{'{{'}} trans('admin.{{ $modelLangFormat }}.actions.create') }}
                    </div>

                    <div class="card-body">
                        {{'@'}}include('admin.{{ $modelDotNotation }}.components.form-elements')
                    </div>
                @endif
                @if(in_array("published_at", array_column($columns->toArray(), 'name')))

                    <button type="submit" class="btn btn-primary fixed-cta-button button-save" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-save'"></i>
                        @{{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>
                    <button type="submit" style="display: none" class="btn btn-success fixed-cta-button button-saved" :disabled="submiting" :class="">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-check'"></i>
                        <span>@{{ trans('brackets/admin-ui::admin.btn.saved') }}</span>
                    </button>
                @else()
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            @{{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                @endif

            </form>

        </{{ $modelJSName }}-form>

        </div>

    @if(!in_array("published_at", array_column($columns->toArray(), 'name')))
    </div>
    @endif

{{'@'}}endsection