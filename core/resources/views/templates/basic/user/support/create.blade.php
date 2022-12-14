@extends($activeTemplate.'layouts.frontend')
@section('content')

    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Support Ticket</h4></div>
            
        </div>

    </div>

    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="message__chatbox bg-white shadow">
                    <div class="message__chatbox__header">
                        <h4 class="title text-white">@lang('Create New Ticket')</h4>
                        <a href="{{route('ticket') }}" class="cmn--btn btn--sm">@lang('My Ticket')</a>
                    </div>
                    <div class="message__chatbox__body">
                        <form class="message__chatbox__form row" action="{{route('ticket.store')}}"  method="POST" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="form--group col-sm-6">
                                <label for="fname" class="cmn--label">@lang('Your Name')</label>
                                <input type="text" class="form-control" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" readonly>
                            </div>
                            <div class="form--group col-sm-6">
                                <label for="username" class="cmn--label">@lang('Email address')</label>
                                <input type="email" class="form-control" name="email" value="{{@$user->email}}">
                            </div>
                            <div class="form--group col-sm-6">
                                <label for="subject" class="cmn--label">@lang('Subject')</label>
                                <input type="text" id="subject" name="subject" class="form-control">
                            </div>
                            <div class="form--group col-sm-6">
                                <label for="subject" class="cmn--label">@lang('Priority')</label>
                                <select class="form-control w-100" name="priority">
                                    <option value="3">@lang('High')</option>
                                    <option value="2">@lang('Medium')</option>
                                    <option value="1">@lang('Low')</option>
                                </select>
                            </div>
                            <div class="form--group col-sm-12">
                                <label for="message" class="cmn--label">@lang('Your Message')</label>
                                <textarea class="form-control"  name="message">{{old('message')}}</textarea>
                            </div>
                            <div class="form--group col-sm-12">
                                <div class="d-flex">
                                    <div class="left-group col p-0">
                                        <label for="file2" class="cmn--label">@lang('Attachments')</label>
                                        <input type="file" class="overflow-hidden form-control mb-2" name="attachments[]">

                                        <div id="fileUploadsContainer"></div>

                                        <span class="info fs--14">@lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')</span>
                                    </div>
                                    <div class="add-area">
                                        <label class="cmn--label d-block">&nbsp;</label>
                                        <a href="javascript:void(0)" class="cmn--btn btn--sm bg--base ms-2 ms-md-4 addFile" type="button"><i class="las la-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form--group col-sm-12 mb-0">
                                <button type="submit" class="cmn--btn w-100 justify-content-center">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            });
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(
                    `<div class="input-group">
                        <input type="file" class="overflow-hidden form-control mt-2 mb-2" name="attachments[]">
                        <div class="input-group-append support-input-group">
                            <a href="javascript:void(0)" class="input-group-text cmn--btn btn--sm bg--danger ms-2 ms-md-4 remove-btn">x</a>
                        </div>
                    </div>`
                )
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);

    </script>
@endpush
