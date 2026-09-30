@extends('admin.layout')
@section('admin-title', 'Blog Posts')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>📝 Blog Posts</h1>
    <p>Create and manage articles shown in your MBBS guides blog.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ New Post</a>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Title</th><th>Category</th><th>Author</th><th>Read Time</th><th>Status</th><th>Published</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
        <tr>
          <td>
            <div style="font-weight:700;max-width:280px;">{{ Str::limit($post->title, 55) }}</div>
            <div style="font-size:0.72rem;color:var(--clr-muted);margin-top:2px;">/blog/{{ $post->slug }}</div>
          </td>
          <td><span class="badge badge-new">{{ $post->category }}</span></td>
          <td>{{ $post->author }}</td>
          <td>{{ $post->read_time }}</td>
          <td>
            {!! $post->is_published
              ? '<span class="badge badge-published">Published</span>'
              : '<span class="badge badge-draft">Draft</span>' !!}
          </td>
          <td style="font-size:0.8rem;color:var(--clr-muted);">
            {{ $post->published_at ? $post->published_at->format('d M Y') : '—' }}
          </td>
          <td>
            <div class="action-row">
              <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-secondary">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7"><div class="empty-state"><div class="empty-icon">📝</div><p>No blog posts yet. Create your first guide!</p></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
