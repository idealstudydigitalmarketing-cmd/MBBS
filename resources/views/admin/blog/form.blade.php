@extends('admin.layout')
@section('admin-title', $post ? 'Edit Post' : 'New Blog Post')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>{{ $post ? '✏️ Edit Post' : '📝 New Blog Post' }}</h1>
    <p>{{ $post ? 'Update the article content and settings.' : 'Write and publish a new MBBS guide or article.' }}</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.blog') }}" class="btn btn-secondary">← Back to Blog</a>
  </div>
</div>

<form method="POST" action="{{ $post ? route('admin.blog.update', $post) : route('admin.blog.store') }}">
  @csrf @if($post) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">

    <!-- LEFT: Content -->
    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>📰 Article Content</h3></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label>Post Title *</label>
              <input type="text" name="title" class="form-control" value="{{ old('title', $post?->title) }}" required placeholder="e.g. Complete Guide to MBBS in Poland 2025" id="post-title"/>
            </div>
            <div class="form-group">
              <label>URL Slug</label>
              <input type="text" name="slug" class="form-control" value="{{ old('slug', $post?->slug) }}" placeholder="auto-generated-from-title" id="post-slug"/>
              <span class="help-text">Leave blank to auto-generate from the title.</span>
            </div>
            <div class="form-group">
              <label>Excerpt / Summary *</label>
              <textarea name="excerpt" class="form-control" rows="3" required maxlength="500" placeholder="A short 1–2 sentence summary displayed on the blog listing page...">{{ old('excerpt', $post?->excerpt) }}</textarea>
            </div>
            <div class="form-group">
              <label>Full Article Content *</label>
              <textarea name="content" class="form-control" rows="18" required id="post-content" placeholder="Write your full article here. You can use HTML tags like &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt; etc.">{{ old('content', $post?->content) }}</textarea>
              <span class="help-text">You can use basic HTML. Headings: &lt;h2&gt;, &lt;h3&gt; | Bold: &lt;strong&gt; | Lists: &lt;ul&gt;&lt;li&gt; | Paragraphs: &lt;p&gt;</span>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>🔍 SEO Settings</h3></div>
        <div class="card-body">
          <div class="form-grid form-grid-2">
            <div class="form-group" style="grid-column:1/-1;">
              <label>Meta Title</label>
              <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $post?->meta_title) }}" placeholder="SEO title (leave blank to use post title)"/>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Meta Description</label>
              <textarea name="meta_description" class="form-control" rows="2" maxlength="500" placeholder="SEO meta description (max 160 chars recommended)">{{ old('meta_description', $post?->meta_description) }}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Settings -->
    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>📋 Post Settings</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:16px;">
          <div class="form-group">
            <label>Category *</label>
            <select name="category" class="form-control" required>
              @foreach(['Guide','Country Info','University','Visa & Docs','FAQ','News','Tips'] as $cat)
              <option value="{{ $cat }}" {{ old('category', $post?->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Author *</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $post?->author ?? 'EuroMedStudy Team') }}" required/>
          </div>
          <div class="form-group">
            <label>Read Time *</label>
            <input type="text" name="read_time" class="form-control" value="{{ old('read_time', $post?->read_time ?? '5 min read') }}" required placeholder="5 min read"/>
          </div>
          <div class="form-group">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $post?->sort_order ?? 0) }}" min="0"/>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>🚀 Publish</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post?->is_published) ? 'checked' : '' }}/>
            <label>Publish Post (make it live)</label>
          </label>
          @if($post?->published_at)
          <p style="font-size:0.78rem;color:var(--clr-muted);">
            Published: {{ $post->published_at->format('d M Y H:i') }}
          </p>
          @endif
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px;">
            💾 {{ $post ? 'Update Post' : 'Save Post' }}
          </button>
        </div>
      </div>
    </div>

  </div>
</form>

<script>
// Auto-generate slug from title
const titleInput = document.getElementById('post-title');
const slugInput  = document.getElementById('post-slug');
if (titleInput && slugInput) {
  titleInput.addEventListener('input', function () {
    if (!slugInput.dataset.edited) {
      slugInput.value = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-');
    }
  });
  slugInput.addEventListener('input', function () {
    this.dataset.edited = 'true';
  });
}
</script>
@endsection
