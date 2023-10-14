<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('admin-course-info*') ? 'active' : '' }}" href="@if($course->id) {{ route('admin.course.info.edit', $course->id) }} @else {{ route('admin.course.info') }} @endif">Course Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('admin-course-image*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('admin.course.image.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Course Image</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-video*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.video.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Promo Video</a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-curriculum*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.course.curriculum.edit', $course->id) }} @else {{ 'javascript:void();' }} @endif">Curriculum</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link py-1 {{ request()->is('instructor-course-quiz*') ? 'active' : '' }} @if(!$course->id) {{ 'course-id-empty' }} @endif" href="@if($course->id) {{ route('instructor.quiz.curriculum', $course->id) }} @else {{ 'javascript:void();' }} @endif">Create Quiz</a>
    </li> -->
</ul>