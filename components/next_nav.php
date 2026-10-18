<style> 
      .bottom-bar {
  height: 70px;
  background: #fff;
  border-top: 2px solid #e5e7eb;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 40px;
  width: 100%;      /* <-- Always full width of .main */
  transition: all 0.45s ease;
  position: relative;
    }

    body.sidebar-collapsed .bottom-bar {
  margin-left: 0 !important;
  width: 100% !important;
}
    .nav-btn {
      background: #2563eb;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 18px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .nav-btn:hover {
      background: #1e4ed8;
    }

</style>

      <div class="bottom-bar" id="bottomBar">
        <button class="nav-btn">⬅ Sebelum</button>
        <button class="nav-btn">Seterusnya ➡</button>
      </div>
