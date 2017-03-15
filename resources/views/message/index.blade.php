@extends('layout.app')
@section('content')
    <aside class="page-aside">
        <div class="be-scroller">
            <div class="aside-content">
                <div class="content">
                    <div class="aside-header">
                        <span class="title">Inbox</span>
                        <br>
                        <div class="btn-group">
                            <button data-toggle="dropdown" type="button" class="btn btn-default btn-md dropdown-toggle">Filter by channel  <span class="caret"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Twitter Messages</a></li>
                                <li><a href="#">Twitter Mentions</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Email</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="aside-nav collapse thread-list">
                    <ul class="nav">
                        @foreach($senders as $s)

                            <li @if(2 == 4) class="active" @endif>
                                <a href="#">
                                    @if(2 == 4)<span class="thread-count label label-primary">8</span>@endif
                                    <div class="thread-avatar" style="background-image:url('{{$s->account_picture}}');"></div>
                                    <span class="thread-name">{{$account->name}}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="active"><a href="#"><span class="label label-default">4</span><i class="icon mdi mdi-case"></i> Important</a></li>
                        <li><a href="#"><i class="icon mdi mdi-file"></i> Drafts</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <div class="main-content container-fluid">
        <div class="email-inbox-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="email-title"><span class="icon mdi mdi-inbox"></span> Inbox <span class="new-messages">(2 new messages)</span>  </div>
                </div>
                <div class="col-md-6">
                    <div class="email-search">
                        <div class="input-group input-search input-group-sm">
                            <input disabled type="text" placeholder="Search mail (available soon)... " class="form-control"><span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="icon mdi mdi-search"></i></button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="email-filters">
            <div class="email-filters-left">
                <div class="be-checkbox be-select-all">
                    <input id="check" type="checkbox">
                    <label for="check"></label>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-default">Save as a report</button>
                    <button type="button" class="btn btn-default">Mark as a review</button>
                </div>

            </div>
            <div class="email-filters-right"><span class="email-pagination-indicator">1-50 of 253</span>
                <div class="btn-group email-pagination-nav">
                    <button type="button" class="btn btn-default"><i class="mdi mdi-chevron-left"></i></button>
                    <button type="button" class="btn btn-default"><i class="mdi mdi-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <div class="email-list">

            <div class="email-list-item email-list-item--unread">
                <div class="email-list-actions">
                    <div class="be-checkbox">
                        <input id="check1" type="checkbox">
                        <label for="check1"></label>
                    </div><a href="#" class="favorite active"><span class="mdi mdi-star"></span></a>
                </div>
                <div class="email-list-detail">
                    <div class="thread-messages">
                        <ul>
                            <li class="message-friend">
                                <div>Hello</div>
                            </li>
                            <li class="message-self">
                                <div>Hi, how are you?</div>
                            </li>
                            <li class="message-friend">
                                <div>Good, I'll need support with my pc</div>
                            </li>
                            <li class="message-self">
                                <div>Sure, just tell me what is going on with your computer?</div>
                            </li>
                            <li class="message-friend">
                                <div>I don't know it just turns off suddenly</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

@endsection