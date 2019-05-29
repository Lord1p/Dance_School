#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "chttpcontroller.h"

MainWindow::MainWindow(QWidget *parent) :
	QMainWindow(parent),
	ui(new Ui::MainWindow)
{
	ui->setupUi(this);
}

MainWindow::~MainWindow()
{
	delete ui;
}

void MainWindow::on_addCourse_2_clicked()
{
	CHttpController::getInstatnce()->GET("http://localhost/DanceSchool/server/get-news.php");
}
