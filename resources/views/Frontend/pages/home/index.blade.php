@extends('Frontend.layouts.master')


@section('content')

<!--====== SLIDER PART START ======-->
    
    @include('frontend.pages.home.sections.hero-section')
    
    <!--====== SLIDER PART ENDS ======-->
   

    <!--====== CATEGORY PART START ======-->
    
    @include('Frontend.pages.home.sections.category-section')
    
    <!--====== CATEGORY PART ENDS ======-->
   

    <!--====== ABOUT PART START ======-->
    
    @include('Frontend.pages.home.sections.about-section')
    
    <!--====== ABOUT PART ENDS ======-->
   

    <!--====== APPLY PART START ======-->
    
    @include('Frontend.pages.home.sections.apply-section')
    
    <!--====== APPLY PART ENDS ======-->
   

    <!--====== COURSE PART START ======-->
    
    @include('Frontend.pages.home.sections.course-section')
    
    <!--====== COURSE PART ENDS ======-->
   

    <!--====== VIDEO FEATURE PART START ======-->
    
    @include('Frontend.pages.home.sections.video-section')
    
    <!--====== VIDEO FEATURE PART ENDS ======-->
   

    <!--====== TEACHERS PART START ======-->
    
    @include('Frontend.pages.home.sections.teachers-section')
    
    <!--====== TEACHERS PART ENDS ======-->

   
    <!--====== TEASTIMONIAL PART START ======-->
    
    {{-- @include('Frontend.pages.home.sections.testimonial-section') --}}
    
    <!--====== TEASTIMONIAL PART ENDS ======-->

   
    <!--====== PATNAR LOGO PART START ======-->
    
    @include('Frontend.pages.home.sections.partner-section')
    
    <!--====== PATNAR LOGO PART ENDS ======-->

@endsection