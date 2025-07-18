 @forelse ($data ?? [] as $d)
     <tr>
         <td>{{ $d?->title }}</td>
         <td>{{ $d?->teacher->name }}</td>
         <td>{{ $d?->subject->name }}</td>
         <td>{{ $d?->class->name }}</td>
         <td>{{ $d?->chapters()->count() }}</td>
         <td>{{ $d?->totalLessons()->count() }}</td>
         <td>
             <!-- Preview Button -->
             <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal{{ $d->id }}">
                 Preview
             </button>

             <!-- Preview Modal -->
             <div class="modal fade" id="previewModal{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true"
                 data-backdrop="static">
                 <div class="modal-dialog modal-xl" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title">Course Preview -
                                 {{ $d->title }}</h5>
                             <button type="button" class="close" data-dismiss="modal">
                                 <span>&times;</span>
                             </button>
                         </div>
                         <div class="modal-body p-0" style="height: 600px;">
                             <iframe src="{{ route('admin.course.preview', $d->id) }}" width="100%" height="100%"
                                 frameborder="0"></iframe>
                         </div>
                     </div>
                 </div>
             </div>
         </td>

         <td>
             @if ($d?->is_approved == 'pending')
                 <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-warning">Pending</span>
             @elseif ($d?->is_approved == 'approved')
                 <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Approved</span>
             @else
                 <span class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-danger">Rejected</span>
             @endif
         </td>

         <td>
             <form action="{{ route('admin.approveSubmit', $d?->id) }}" method="POST"
                 class="statusFormSubmit-{{ $d?->id }}">
                 @csrf
                 <select name="status" id=""
                     onchange="$('.statusFormSubmit-{{ $d?->id }}').trigger('submit')">
                     <option value="">--Select--</option>
                     <option value="approved">Approved</option>
                     <option value="rejected">Rejected</option>
                 </select>
             </form>
         </td>




     </tr>
 @empty
     <tr class="text-center">
         <td colspan='9'>No data found</td>
     </tr>
 @endforelse
