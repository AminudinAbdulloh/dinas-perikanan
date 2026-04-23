<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class VisitorFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $agent = $request->getUserAgent();
        
        // Mencegah bot menambah jumlah statistik
        if ($agent->isRobot()) {
            return;
        }

        $session = \Config\Services::session();
        
        // Memastikan data pengunjung tidak bertambah hanya dengan merefresh
        // dengan menggunakan session `has_visited`
        if (!$session->has('has_visited') && \App\Models\VisitorModel::tableReady()) {
            $visitorModel = new \App\Models\VisitorModel();
            
            $visitorModel->insert([
                'ip_address' => $request->getIPAddress(),
                'user_agent' => $agent->getAgentString(),
            ]);
            
            $session->set('has_visited', true);
        }

        // Catat setiap tayangan halaman (Page View)
        if (\App\Models\PageViewModel::tableReady()) {
            $pageViewModel = new \App\Models\PageViewModel();
            $pageViewModel->insert([
                'url' => current_url(),
            ]);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
